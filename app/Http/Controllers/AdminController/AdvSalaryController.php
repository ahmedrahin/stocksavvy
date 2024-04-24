<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvSalary;
use App\Models\Employees;
use Illuminate\Validation\Rule;

class AdvSalaryController extends Controller
{
    public function manage()
    {
        $adv_salaries = AdvSalary::all();
        return view('backend.pages.salaries.adv_salaries.manage', compact('adv_salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $employees = Employees::orderBy('name', 'asc')->get();
        return view('backend.pages.salaries.adv_salaries.add', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
           "emp"          => "required",
           'salary_date'  => 'required',
           'year'         => 'required',
           'month'        => 'required',
           'adv_salary'   => 'required',
       ],[
           'emp.required'         => "Please select employee name",
           'salary_date.required' => "Please select salary date",
       ]);

       $existingSalary = AdvSalary::where('emp_id', $request->emp)
                            ->where('month', $request->month)
                            ->where('year', $request->year)
                            ->first();

         // If advance salary for the selected employee in the specified month and year already exists, show error message
        if ($existingSalary) {
            return response()->json([
                'errors' => [
                    'adv_salary' => 'Advance salary for this employee in the selected month and year already provided.'
                ]
            ], 422);
        }

       $salary = new AdvSalary();

       $salary->emp_id        = $request->emp;
       $salary->month         = $request->month;
       $salary->year          = $request->year;
       $salary->salary_date   = $request->salary_date;
       $salary->adv_salary    = $request->adv_salary;
       $salary->save();
   }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employees = Employees::orderBy('name', 'asc')->get();
        $edit = AdvSalary::find($id);
        $editData = AdvSalary::where('id', $edit->id)->first();
        return view('backend.pages.salaries.adv_salaries.edit', compact('editData', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update id
        $update = AdvSalary::find($id);

         // Validation
        $request->validate([
            "emp"          => "required",
            'salary_date'  => 'required',
            'year'         => 'required',
            'month'        => 'required',
            'adv_salary'   => ['required', Rule::unique('adv_salaries')->ignore($update->id ? $update->id : null)],
        ], [
            'emp.required'         => "Please select an employee name.",
            'salary_date.required' => "Please select a salary date.",
        ]);

        // Check if advance salary for the selected employee in the specified month and year already exists
        $existingSalary = AdvSalary::where('emp_id', $request->emp)
                                    ->where('month', $request->month)
                                    ->where('year', $request->year)
                                    ->first();

        if ($existingSalary && !$update->id) {
            return response()->json([
                'errors' => [
                    'adv_salary' => 'Advance salary for this employee in the selected month and year already exists. Please modify as necessary.'
                ]
            ], 422);
        } 

         $update->emp_id        = $request->emp;
         $update->month         = $request->month;
         $update->year          = $request->year;
         $update->salary_date   = $request->salary_date;
         $update->adv_salary    = $request->adv_salary;
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
        $delete = AdvSalary::find($id);
        if ($delete) {
            $delete->delete();
            return response()->json([
                'message' => 'Employee adv-salary deleted successfully.',
            ]);
        } else {
            return response()->json(['error' => 'Not found.'], 404);
        }
    }
}
