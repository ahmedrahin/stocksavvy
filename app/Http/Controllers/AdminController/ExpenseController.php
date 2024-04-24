<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {   
        $expenses = Expense::all();
        return view('backend.pages.expenses.manage', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.expenses.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            "amn"   => "required|numeric",
            'month' => 'required',
            'date'  => 'required',
        ],);

        $expense = new Expense();

        $expense->amn         = $request->amn;
        $expense->month       = $request->month;
        $expense->date        = $request->date;
        $expense->details     = $request->details;
        // save
        $expense->save();
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
        $delete = Expense::find($id);
        if ($delete) {
            $delete->delete();
            return response()->json([
                'message' => 'Expense deleted successfully.',
            ]);
        } else {
            return response()->json(['error' => 'Expense not found.'], 404);
        }
    }
}
