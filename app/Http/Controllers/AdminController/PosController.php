<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Order;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $categories = Category::orderBy('cat_name', 'asc')->where('status', 1)->get();
        $products   = Product::orderBy('title', 'asc')->where('status', 1)->get();
        $customers  = Customer::orderBy('name', 'asc')->get();

        return view('backend.pages.pos.pos', compact('products', 'categories', 'customers'));
    }

    // add to cart
    public function add_cart(Request $request){
        $cart = new Cart();
        $cart->product_id       = $request->product_id;
        $cart->product_quantity = $request->qty;
        $cart->save();

        $customers  = Customer::orderBy('name', 'asc')->get();
        $products   = Product::orderBy('title', 'asc')->where('status', 1)->get();
        return response()->json([
            'html' => view('backend.pages.pos.cart', compact('customers'))->render(),
            'html2' => view('backend.pages.pos.product', compact('products'))->render(),
        ]);
    }

    // update cart
    public function update_cart(Request $request, string $id){
        $cart = Cart::findOrFail($id);
        // Update the quantity
        $cart->product_quantity = $request->newQuantity;
        $cart->save();

        $customers  = Customer::orderBy('name', 'asc')->get();
        $products   = Product::orderBy('title', 'asc')->where('status', 1)->get();
        return response()->json([
            'html' => view('backend.pages.pos.cart', compact('customers'))->render(),
            'html2' => view('backend.pages.pos.product', compact('products'))->render(),
            'msg' => 'Item Quantity Updated Into Cart',
        ]);
    }

    // del cart
    public function del_cart(string $id){
        $del  = Cart::find($id);
        $del->delete();

        $customers  = Customer::orderBy('name', 'asc')->get();
        $products   = Product::orderBy('title', 'asc')->where('status', 1)->get();
        return response()->json([
            'html' => view('backend.pages.pos.cart', compact('customers'))->render(),
            'html2' => view('backend.pages.pos.product', compact('products'))->render(),
        ]);
    }

     // place order
     public function place_order(Request $request){
        
        // validation
        $request->validate([
            "pstatus"    => "required",
            "status"     => "required",
            'order_date' => 'nullable|date_format:"d M, Y"',
            'issue_date' => 'nullable|date_format:"d M, Y"|after_or_equal:order_date',
        ],[
            "pstatus.required" => "Please select a payment status",
            "status.required"  => "Please select a order status"
        ]);

        $order = new Order();
        $order->customer_id             = $request->customer;
        $order->total_amn               = Cart::totalAmount();
        $order->paid_amn                = $request->paid;
        $order->discount_amn            = $request->discount;
        $order->vat                     = $request->vat;
        $order->payment_status          = $request->pstatus;
        $order->status                  = $request->status;
        $order->order_date              = $request->order_date;
        $order->issue_date              = $request->issue_date;
        // save
        $order->save();

        // update product qty & order id
        foreach( Cart::totalItems() as $cart ){
            $cart->order_id  = $order->id;
            $cart->save();
            // - product quantity
            $product = Product::where('id', $cart->product_id)->first();
            $up_qunt = $product->qty - $cart->product_quantity;
            $product->update(['qty' => $up_qunt ]);
        }

        return redirect('manage.order');

        // $customers  = Customer::orderBy('name', 'asc')->get();
        // $products   = Product::orderBy('title', 'asc')->where('status', 1)->get();
        // return response()->json([
        //     'html' => view('backend.pages.pos.cart', compact('customers'))->render(),
        //     'html2' => view('backend.pages.pos.product', compact('products'))->render(),
        // ]);
    }

    
}
