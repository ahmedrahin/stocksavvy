<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $categories = Category::orderBy('cat_name', 'asc')->get();
        return view('backend.pages.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|unique:categories,cat_name',
        ],[
            "name.required" => "The category name is required."
        ]);

        $category = new Category();

        $category->cat_name  = $request->name;
        $category->status    = $request->status;
        // save
        $category->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $theCat = str_replace('_', ' ',  $name);
        $showData   = Category::where('cat_name', strtoupper($theCat))->first();
        
        // product
        $products = Product::where('cat_id', $showData->id)->get();
        return view('backend.pages.category.show', compact('showData', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $edit = Category::find($id);
        $editData = Category::where('id', $edit->id)->first();
        return view('backend.pages.category.edit', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        // update id
        $update = Category::find($id);

        // validation
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'cat_name')->ignore($id)],
        ],[
            "name.required" => "The category name is required."
        ]);

        $update->cat_name     = $request->name;
        $update->status       = $request->status;

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
        $update = Category::find($id);
        $update->status = $request->status;
        // save
        $update->save();

        $message = $request->status == 0 ? 'Category status is off' : 'Category status is on';
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
        $delete = Category::find($id);
        if ($delete) {
            $delete->delete();
            return response()->json([
                'message' => 'Category deleted successfully.',
            ]);
        } else {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    
    }
}
