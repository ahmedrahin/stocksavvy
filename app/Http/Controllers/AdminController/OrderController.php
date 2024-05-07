<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {   
        $orders = Order::orderBy('id', 'desc')->get();
        return view('backend.pages.order.manage', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        $details = Order::where('id', $order->id)->first();
        $items  = Cart::where('order_id', $order->id)->get();
        return view('backend.pages.order.details', compact('details', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Order::find($id);
        $update->status = $request->order_status;
        $update->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Order::find($id);
        if ($delete) {
            $delete->delete();
            return response()->json([
                'message' => 'Order deleted successfully.',
            ]);
        } else {
            return response()->json(['error' => 'Order not found.'], 404);
        }
    }

    // order invoice
    public function order_invoice(string $id)
    {   
        $order          = Order::find($id);
        $order_invoice  = Order::where('id', $order->id)->first();
        $items          = Cart::where('order_id', $order->id)->get();
        return view('backend.pages.pos.invoice', compact('order_invoice', 'items'));
    }
}
