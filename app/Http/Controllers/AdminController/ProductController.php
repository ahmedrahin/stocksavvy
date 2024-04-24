<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Suplliers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Validation\Rule;
use Illuminate\support\Str;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $products = Product::orderBy('title', 'asc')->get();
        return view('backend.pages.product.manage', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('cat_name', 'asc')->where('status', 1)->get();
        $suplliers = Suplliers::orderBy('name', 'asc')->get();
        return view('backend.pages.product.add', compact('categories','suplliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required|unique:products,title',
            'category' => 'required',
            'qty' => 'required',
            'buy_date' => 'nullable|date_format:"d M, Y"',
            'ex_date' => 'nullable|date_format:"d M, Y"|after_or_equal:buy_date',
        ],);

        $product = new Product();

         // image 
        if ($request->image) {
            $manager = new ImageManager(new Driver());
            $name_gan = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize(500, 480);
            $image->save(base_path('public/backend/images/product/' . $name_gan));

            $product->image = 'backend/images/product/' . $name_gan;
        }

        $product->title             = $request->title;
        $product->slug              = Str::slug($request->title);
        $product->cat_id            = $request->category;
        $product->sup_id            = $request->sup;
        $product->code              = $request->code;
        $product->place             = $request->place;
        $product->route             = $request->route;
        $product->buy_date          = $request->buy_date;
        $product->expire_date       = $request->ex_date;
        $product->buying_price      = $request->buying_price;
        $product->selling_price     = $request->selling_price;
        $product->qty               = $request->qty;
        $product->status            = $request->status;
        // save
        $product->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $showData = Product::where('slug', $slug)->first();
        if ($showData) {
            return view('backend.pages.product.show', compact('showData'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Product::find($id);
        $editData = Product::where('id', $edit->id)->first();
        $categories = Category::orderBy('cat_name', 'asc')->where('status', 1)->get();
        $suplliers = Suplliers::orderBy('name', 'asc')->get();
        return view('backend.pages.product.edit', compact('editData', 'categories','suplliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update id
        $update = Product::find($id);

        // validation
        $request->validate([
            'title'        =>  ['required', Rule::unique('products')->ignore($update->id)],
            'category'     => 'required',
            'qty'          => 'required',
            'buy_date'     => 'nullable|date_format:"d M, Y"',
            'ex_date'      => 'nullable|date_format:"d M, Y"|after_or_equal:buy_date',
        ],[
            'type.required' => "Please select supplier type"
        ]);

         // image 
        if($request->hasRemove){
            // delete employee image
            if (File::exists($update->image)) {
                File::delete($update->image);
            }
            $update->image = null;
        }
        elseif ($request->image) {
            // delete employee image
            if (File::exists($update->image)) {
                File::delete($update->image);
            }

            $manager = new ImageManager(new Driver());
            $name_gan = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize(250, 200);
            $image->save(base_path('public/backend/images/product/' . $name_gan));

            $update->image = 'backend/images/product/' . $name_gan;
        }

        $update->title             = $request->title;
        $update->slug              = Str::slug($request->title);
        $update->cat_id            = $request->category;
        $update->sup_id            = $request->sup;
        $update->code              = $request->code;
        $update->place             = $request->place;
        $update->route             = $request->route;
        $update->buy_date          = $request->buy_date;
        $update->expire_date       = $request->ex_date;
        $update->buying_price      = $request->buying_price;
        $update->selling_price     = $request->selling_price;
        $update->qty               = $request->qty;
        $update->status            = $request->status;
        // save
        $update->save();

       // Return success response with the updated employee data
        return response()->json([
            'success' => 'Information updated successfully.',
            'editData' => $update
        ], 200);
    }

    public function activeStatus(Request $request, string $id)
    {   
        // update id
        $update = Product::find($id);
        $update->status = $request->status;
        // save
        $update->save();

        $message = $request->status == 0 ? 'Product status is off' : 'Product status is on';
        $type    = $request->status == 0 ? 'info' : 'success';
        return response()->json([
            'msg' => $message,
            'type' => $type,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Product::find($id);
        if ($delete) {
            $delete->delete();
            // delete product image
            if (File::exists($delete->image)) {
                File::delete($delete->image);
            }
            return response()->json([
                'message' => 'Product deleted successfully.',
            ]);
        } else {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }
}
