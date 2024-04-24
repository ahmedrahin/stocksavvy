<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $employees = Employees::orderBy('name', 'asc')->get();
        return view('backend.pages.employees.manage', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.employees.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // validation
        $request->validate([
            "name" => "required",
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric',
        ],);

        $employees = new Employees();

         // image 
        if ($request->image) {
            $manager = new ImageManager(new Driver());
            $name_gan = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize(250, 200);
            $image->save(base_path('public/backend/images/employee/' . $name_gan));

            $employees->image = 'backend/images/employee/' . $name_gan;
        }

        $employees->name        = $request->name;
        $employees->email       = $request->email;
        $employees->phone       = $request->phone;
        $employees->address     = $request->address;
        $employees->salary      = $request->salary;
        $employees->city        = $request->city;
        $employees->experience  = $request->experience;
        $employees->vacation    = $request->vacation;
        // save
        $employees->save();
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Employees::find($id);
        $editData = Employees::where('id', $edit->id)->first();
        return view('backend.pages.employees.edit', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        // update id
        $update = Employees::find($id);

        // validation
        $request->validate([
            "name" => "required",
            'email'  =>  ['required', Rule::unique('employees')->ignore($update->id)],
            'phone' => 'required|numeric',
        ],);

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
            $image->save(base_path('public/backend/images/employee/' . $name_gan));

            $update->image = 'backend/images/employee/' . $name_gan;
        }

        $update->name        = $request->name;
        $update->email       = $request->email;
        $update->phone       = $request->phone;
        $update->address     = $request->address;
        $update->salary      = $request->salary;
        $update->city        = $request->city;
        $update->experience  = $request->experience;
        $update->vacation    = $request->vacation;
        // save
        $update->save();
       // Return success response with the updated employee data
        return response()->json([
            'success' => 'Information updated successfully.',
            'editData' => $update
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Employees::find($id);
        if ($delete) {
            $delete->delete();
            // delete employee image
            if (File::exists($delete->image)) {
                File::delete($delete->image);
            }
            return response()->json([
                'message' => 'Employee deleted successfully.',
            ]);
        } else {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }
}
