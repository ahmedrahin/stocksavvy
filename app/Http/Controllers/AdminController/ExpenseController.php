<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;

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

    // today expense
    public function today()
    {   
        $today    = Carbon::now()->format('d M, Y');
        $expenses = Expense::where('date', $today)->get();
        return view('backend.pages.expenses.today', compact('expenses'));
    }

     // month expense
     public function month()
     {   
         $month        = Carbon::now()->format('n');
         $monthname    = Carbon::now()->format('M');
         $year         = Carbon::now()->format('Y');
         $date         = null;
         $expenses     = Expense::where('month', $month)->where('year', $year)->get();
         return view('backend.pages.expenses.month', compact('expenses', 'year', 'monthname', 'date'));
     }

     // year expense
     public function year()
     {   
         $year     = Carbon::now()->format('Y');
         $expenses = Expense::where('year', $year)->get();
         return view('backend.pages.expenses.year', compact('expenses', 'year'));
     }

     // monthly expenses
     public function monthlyExpenses($month)
     {     
        $monthName = [
            'jan' => 1,
            'feb' => 2,
            'mar' => 3,
            'apr' => 4,
            'may' => 5,
            'jun' => 6,
            'jul' => 7,
            'aug' => 8,
            'sep' => 9,
            'oct' => 10,
            'nov' => 11,
            'dec' => 12,
        ];

        // $theMonth = array_flip($monthName);

        $year = Carbon::now()->format('Y');
        $isMonth = Carbon::now()->format('y');
        $getMonth = ucfirst($month). "-" .$isMonth;
        $theMonth = ucfirst($month);
        $date     = null;
        $expenses = Expense::where('month', '=', $monthName[$month])->where('year', $year)->get();

        return view('backend.pages.expenses.month', ['expenses' => $expenses, 'year' => $year, 'getMonth' => $getMonth, 'theMonth' => $theMonth, 'date' => $date]);
     }

     // monthlyDayExpenses expenses
     public function monthlyDayExpenses(Request $request)
     {     
        $date     = $request->input('date');
        $year     = $request->input('year');
        $getMonth = date('d-M', strtotime($date));
        $theMonth = date('M', strtotime($date));
  
        $expenses = Expense::where('date', $date)->get();
         return view('backend.pages.expenses.month', ['expenses' => $expenses, 'year' => $year, 'getMonth' => $getMonth, 'theMonth' => $theMonth, 'date' => $date]);
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
            'year'  => 'required',
        ],);

        $expense = new Expense();

        $expense->amn         = $request->amn;
        $expense->month       = $request->month;
        $expense->date        = $request->date;
        $expense->details     = $request->details;
        $expense->year        = $request->year;
        // save
        $expense->save();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Expense::find($id);
        $editData = Expense::where('id', $edit->id)->first();
        return view('backend.pages.expenses.edit', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $update = Expense::find($id);
        // validation
        $request->validate([
            "amn"   => "required|numeric",
            'month' => 'required',
            'date'  => 'required',
            'year'  => 'required',
        ],);

        $update->amn         = $request->amn;
        $update->month       = $request->month;
        $update->date        = $request->date;
        $update->details     = $request->details;
        $update->year        = $request->year;
        // save
        $update->save();
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
                // 'html'    => view('backend.pages.expenses.info')->render()
            ]);
        } else {
            return response()->json(['error' => 'Expense not found.'], 404);
        }
    }
}
