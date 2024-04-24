<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employees;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pay_salary()
    {
        $employees = Employees::all();
        return view('backend.pages.salaries.pay_salary', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $employees = Employees::orderBy('name', 'asc')->get();
        return view('backend.pages.salaries.add', compact('employees'));
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

       $existingSalary = Salary::where('emp_id', $request->emp)
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

       $salary = new Salary();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
