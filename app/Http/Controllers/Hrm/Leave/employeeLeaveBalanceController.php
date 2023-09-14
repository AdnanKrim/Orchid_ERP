<?php

namespace App\Http\Controllers\Hrm\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HRMS\Department;
use App\Models\HRMS\Designation;
use App\Models\HRMS\Leave\LeaveType;
use App\Models\HRMS\Leave\ApplyLeave;
class employeeLeaveBalanceController extends Controller
{
    public function employeeLeaveBalance(){
        $users = User::all();
        $departments = Department::all();
        $designations = Designation::all();
        $leaveTypes = LeaveType::all();
        $applyLeaves =ApplyLeave::all();
       return view('Hrm.Leave.employeeLeaveBalance')->with('users',$users)->with('departments',$departments)->with('designations',$designations)->with('leaveTypes',$leaveTypes)->with('applyLeaves',$applyLeaves);
    }
}
