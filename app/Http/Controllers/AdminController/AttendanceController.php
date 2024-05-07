<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Attendance;
use Carbon\Carbon;
use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $attendances = DB::table('attendances')
            ->select(DB::raw('MAX(id) as id'), 'att_date', 'att_year', 
                    DB::raw('MAX(edit_date) as edit_date'),
                    DB::raw('SUM(CASE WHEN att = "absence" THEN 1 ELSE 0 END) as absence_count'),
                    DB::raw('SUM(CASE WHEN att = "present" THEN 1 ELSE 0 END) as present_count'))
            ->groupBy('att_date', 'att_year')
            ->get();

    
        return view('backend.pages.attendence.manage', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function take()
    {   
        $employees = Employees::orderBy('name', 'asc')->get();
        return view('backend.pages.attendence.take', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            "date"  => "required",
            'year'  => 'required',
            'emp.*' => 'required',
            'att'   => 'required',
        ]);

        // condition
        $date = $request->date;
        $att_date = Attendance::where('att_date', $date)->first();
        if($att_date){
            return response()->json(['error' => 'Today Attendance Already Taken'], 422);
        }else{
            foreach($request->emp as $employeeId){
                $attendance = new Attendance();
                $attendance->emp_id     = $employeeId;
                $attendance->att_date   = $request->date;
                $attendance->att_year   = $request->year;
                $attendance->att        = $request->att[$employeeId];
                $attendance->edit_date  = date("d_m_y");
                $attendance->month      = date("M");
                
                $attendance->save();
            }  
        }
           
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $edit_date)
    {   
        $edit_date_time = $edit_date;
        $editData = Attendance::where('edit_date', $edit_date_time)->get();
        return view('backend.pages.attendence.edit', compact('editData', 'edit_date_time'));
    }

    public function month_attendance()
    {   
        $employees = Employees::orderBy('name', 'asc')->get();
        return view('backend.pages.attendence.monthly-attendance', compact('employees'));
    }

    public function monthly_attendance($month)
    {   
        
        $year           = date('Y');
        $isJanExists    = DB::table('attendances')->where('month', $month)->where('att_year', $year)->exists();
        $month          = ucfirst($month);
        $isMonth        = Carbon::now()->format('y');
        $getMonth       = ucfirst($month). "-" .$isMonth;
        $employees      = Employees::orderBy('name', 'asc')->get();
        return view('backend.pages.attendence.monthly-attendance', compact('employees', 'month', 'getMonth', 'isJanExists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $edit_date)
    {
        $updates  = Attendance::where('edit_date', $edit_date)->get();

        // validation
        $request->validate([
            'att'   => 'required',
        ]);

        foreach ($updates as $update) {
            $employeeId   = $update->emp_id;
            $update->att = $request->att[$employeeId];
            $update->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
