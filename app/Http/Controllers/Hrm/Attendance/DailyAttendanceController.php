<?php

namespace App\Http\Controllers\Hrm\Attendance;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\HRMS\Department;
use App\Models\HRMS\Designation;
use App\Models\HRMS\Shift\HrmShift;
use App\Models\HRMS\Leave\ApplyLeave;
use App\Models\HRMS\Attendance;
use App\Models\HRMS\Shift\ShiftSchedule;
use App\Models\User;
class DailyAttendanceController extends Controller
{
    public function dailyAttendance(){
        date_default_timezone_set('Asia/Dhaka');
        $paymentDate = date("Y-m-d");
        $day = date('l', strtotime($paymentDate));
        $data = [];
        $leaves = ApplyLeave::whereDate('startDate','<=',$paymentDate)->whereDate('endDate','>=',$paymentDate)->where('status',1)->get();
        if($leaves){
        foreach($leaves as $leave){
            $data[] = $leave->Employee;
        }
    }
        $offDayEmployees = User::where('offDays', 'like', "%$day%")->where('Status',1)->get();
        $users = User::all();
        $todaysUser = User::where('Status','1')->where('offDays', 'not like', "%$day%")->whereNotIn('id',$data)->get();
        $departments = Department::all();
        $designations = Designation::all();
        $shifts = HrmShift::all();
        $attendances = Attendance::where('Date',$paymentDate)->get();
        $present = Attendance::where('Date',$paymentDate)->where('Status',1)->get();
        $absent = Attendance::where('Date',$paymentDate)->where('Status',0)->get();
        $late = Attendance::where('Date',$paymentDate)->where('Status',1)->where('late','<>',null)->get();
        $earlyExit = Attendance::where('Date',$paymentDate)->where('Status',1)->where('EarlyExit','<>',null)->get();
        return view('Hrm.Attendance.dailyAttendance')->with('users',$users)->with('departments',$departments)->with('designations',$designations)->with('shifts',$shifts)->with('offDayEmployees',$offDayEmployees)->with('todaysUser',$todaysUser)->with('leaves',$leaves)->with('attendances',$attendances)->with('present',$present)->with('absent',$absent)->with('late',$late)->with('earlyExit',$earlyExit);
    }
    public function filterAttendance(Request $request){
        if(empty($request->employee)){
            date_default_timezone_set('Asia/Dhaka');
            $paymentDate = date($request->date);
            $day = date('l', strtotime($paymentDate));
            $data = [];
            $leaves = ApplyLeave::whereDate('startDate','<=',$paymentDate)->whereDate('endDate','>=',$paymentDate)->where('status',1)->get();
            if($leaves){
                foreach($leaves as $leave){
                    $data[] = $leave->Employee;
                }
            }
            $offDayEmployees = User::where('offDays', 'like', "%$day%")->where('Status',1)->get();
            $users = User::all();
            $todaysUser = User::where('Status','1')->where('offDays', 'not like', "%$day%")->whereNotIn('id',$data)->get();
            $departments = Department::all();
            $designations = Designation::all();
            $shifts = HrmShift::all();
            $attendances = Attendance::where('Date',$paymentDate)->get();
            $present = Attendance::where('Date',$paymentDate)->where('Status',1)->get();
            $absent = Attendance::where('Date',$paymentDate)->where('Status',0)->get();
            $late = Attendance::where('Date',$paymentDate)->where('Status',1)->where('late','<>',null)->get();
            $earlyExit = Attendance::where('Date',$paymentDate)->where('Status',1)->where('EarlyExit','<>',null)->get();
            return view('Hrm.Attendance.filterAttendance')->with('date',$request->date)->with('users',$users)->with('departments',$departments)->with('designations',$designations)->with('shifts',$shifts)->with('offDayEmployees',$offDayEmployees)->with('todaysUser',$todaysUser)->with('leaves',$leaves)->with('attendances',$attendances)->with('present',$present)->with('absent',$absent)->with('late',$late)->with('earlyExit',$earlyExit);
        }
        else{
            date_default_timezone_set('Asia/Dhaka');
            $paymentDate = date($request->date);
            $day = date('l', strtotime($paymentDate));
            $data = [];
            $leaves = ApplyLeave::whereDate('startDate','<=',$paymentDate)->whereDate('endDate','>=',$paymentDate)->where('status',1)->get();
            if($leaves){
                foreach($leaves as $leave){
                    $data[] = $leave->Employee;
                }
            }
            $offDayEmployees = User::where('offDays', 'like', "%$day%")->where('Status',1)->get();
            $users = User::all();
            $todaysUser = User::where('Status','1')->where('id',$request->employee)->where('offDays', 'not like', "%$day%")->whereNotIn('id',$data)->get();
            $departments = Department::all();
            $designations = Designation::all();
            $shifts = HrmShift::all();
            $attendances = Attendance::where('Date',$paymentDate)->get();
            $present = Attendance::where('Date',$paymentDate)->where('Status',1)->get();
            $absent = Attendance::where('Date',$paymentDate)->where('Status',0)->get();
            $late = Attendance::where('Date',$paymentDate)->where('Status',1)->where('late','<>',null)->get();
            $earlyExit = Attendance::where('Date',$paymentDate)->where('Status',1)->where('EarlyExit','<>',null)->get();
            return view('Hrm.Attendance.filterAttendance')->with('date',$request->date)->with('users',$users)->with('departments',$departments)->with('designations',$designations)->with('shifts',$shifts)->with('offDayEmployees',$offDayEmployees)->with('todaysUser',$todaysUser)->with('leaves',$leaves)->with('attendances',$attendances)->with('present',$present)->with('absent',$absent)->with('late',$late)->with('earlyExit',$earlyExit);
        }
    }
    public function Attendance(){
        date_default_timezone_set('Asia/Dhaka');
        $paymentDate = date("Y-m-d");
        $day = date('l', strtotime($paymentDate));
        $data = [];
        $leaves = ApplyLeave::whereDate('startDate','<=',$paymentDate)->whereDate('endDate','>=',$paymentDate)->where('status',1)->get();
        if($leaves){
        foreach($leaves as $leave){
            $data[] = $leave->Employee;
        }
    }
        $users = User::where('Status',1)->where('offDays', 'not like', "%$day%")->whereNotIn('id',$data)->get();
        return view('Hrm.Attendance.takeAttendance')->with('users',$users);;
    }
    public  function  AttendancePost(Request $request){
        date_default_timezone_set('Asia/Dhaka');
        $paymentDate = date("Y-m-d");
        $attendanceCheck = Attendance::where('Date',$paymentDate)->where('Employee',$request->employee)->first();
        if ($attendanceCheck){return  redirect()->route('dailyAttendance')->with('Error_Message', 'Department Addedd Successfully');}
        else {
            $attendance = new Attendance();
            if ($request->status === "0") {
                $attendance->Date = $request->date;
                $attendance->Employee = $request->employee;
                $attendance->Status = $request->status;
                $attendance->save();
                return redirect()->route('dailyAttendance')->with('Create_Message', 'Department Addedd Successfully');
            } elseif ($request->status === "1") {
                if (Carbon::parse($request->inTime) < Carbon::parse($request->outTime)) {
                    $attendance->Date = $request->date;
                    $day = date('l', strtotime($request->date));
                    $attendance->Employee = $request->employee;
                    $attendance->Status = $request->status;
                    $attendance->inTime = $request->inTime;
                    $attendance->outTime = $request->outTime;
                    $inTime = Carbon::parse($request->inTime);
                    $outTime = Carbon::parse($request->outTime);
                    $workingHour = round(($outTime->diffInMinutes($inTime)) / 60, 2);
                    $attendance->WorkingHour = $workingHour;
                    $employeeShift = User::where('id', $request->employee)->first();
                    $shift = ShiftSchedule::where('shiftName', $employeeShift->shift)->first();
                    $datas = json_decode($shift->time);
                    foreach ($datas as $data) {
                        if ($data->dayName === $day) {
                            $startTime = Carbon::parse($data->inTime);
                            $finishTime = Carbon::parse($data->outTime);
                        }
                    }
                    if ($startTime < $inTime) {
                        $lateTime = round(($inTime->diffInMinutes($startTime)) / 60, 2);
                        $attendance->Late = $lateTime;
                    }
                    if ($outTime < $finishTime) {
                        $earlyExit = round(($finishTime->diffInMinutes($outTime)) / 60, 2);
                        $attendance->EarlyExit = $earlyExit;
                    }
                    if ($finishTime < $outTime) {
                        $otHour = round(($outTime->diffInMinutes($finishTime)) / 60, 2);
                        $attendance->OtHour = $otHour;
                    }
                    $attendance->save();
                    return redirect()->route('dailyAttendance')->with('Create_Message', 'Department Addedd Successfully');
                }
            }
        }
    }
}
