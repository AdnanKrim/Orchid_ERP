<?php

namespace App\Http\Controllers\Hrm\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Leave\ApplyLeave;
use App\Models\HRMS\Leave\LeaveType;
use App\Models\HRMS\Leave\LeavePurpose;
use App\Models\User;
class ApplyLeaveController extends Controller
{
    public function addApplyLeave(){
        $users = User::all();
        $leaveTypes = LeaveType::all();
        $leavePurposes = LeavePurpose::all();
        return view('Hrm.Leave.ApplyLeave.addApplyLeave')->with('users',$users)->with('leaveTypes',$leaveTypes)->with('leavePurposes',$leavePurposes);
    }
    public function ApplyLeaveList(){
        $applyLeaves = ApplyLeave::all();
        $users = User::all();
        $leaveTypes = LeaveType::all();
        $leavePurposes = LeavePurpose::all();
        return view('Hrm.Leave.ApplyLeave.applyLeaveList')->with('applyLeaves',$applyLeaves)->with('users',$users)->with('leaveTypes',$leaveTypes)->with('leavePurposes',$leavePurposes);
    }
    public function addApplyLeavePost(Request $request){
        $applyLeave = new ApplyLeave();
        $applyLeave->dateOfApplication = $request->applyDate;
        $applyLeave->leaveDate = $request->leaveDate;
        $applyLeave->Employee = $request->employee;
        $applyLeave->LeaveType = $request->leaveType;
        $applyLeave->LeavePurpose = $request->leavePurpose;
        $applyLeave->startDate = $request->startDate;
        $applyLeave->endDate = $request->endDate;
        $applyLeave->totalDays = $request->totalDays;
        $applyLeave->details = $request->details;
        $applyLeave->status = 0;
        if($request->hasfile('file')){
            $file = $request->file('file')->getClientOriginalName();
            $folder = $request->file('file')->move(public_path('leave_file').'/',$file);
        }
        else{
            $file = null;
        }
        $applyLeave->file = $file;
        $applyLeave->save();
        return  redirect()->route('ApplyLeaveList')->with('Create_Message', 'New Apply Leave added successfully');
    }
    public function statusUpdate(Request $request){
        $applyLeave = ApplyLeave::where('id',$request->id)->first();
        $applyLeave->status = $request->status;
        $applyLeave->save();
        return "Successfull";
    }
    public function ApplyLeaveInfo(Request $request){
        $applyLeave = ApplyLeave::where('id',$request->id)->first();
        return $applyLeave;
    }
    public function ApplyLeaveDelete(Request $request){
        $applyLeave = ApplyLeave::where('id',$request->id)->delete();
        return  redirect()->route('ApplyLeaveList')->with('Delete_Message', 'Holiday deleted successfully');
    }
    public function getApplyLeave(Request $request){
        $applyLeave = ApplyLeave::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$applyLeave->Employee)->first();
        $leaveTypes = LeaveType::all();
        $typesName = LeaveType::where('id',$applyLeave->LeaveType)->first();
        $leavePurposes = LeavePurpose::all();
        $purposeName = LeavePurpose::where('id',$applyLeave->LeavePurpose)->first();
        return  view('Hrm.Leave.ApplyLeave.updateApplyLeave')->with('applyLeave',$applyLeave)->with('users',$users)->with('userName',$userName)->with('leaveTypes',$leaveTypes)->with('typesName',$typesName)->with('leavePurposes',$leavePurposes)->with('purposeName',$purposeName);
    }
    public function ApplyLeaveUpdate(Request $request){
        $applyLeave = ApplyLeave::where('id',$request->id)->first();
        $applyLeave->dateOfApplication = $request->applyDate;
        $applyLeave->leaveDate = $request->leaveDate;
        $applyLeave->Employee = $request->employee;
        $applyLeave->LeaveType = $request->leaveType;
        $applyLeave->LeavePurpose = $request->leavePurpose;
        $applyLeave->startDate = $request->startDate;
        $applyLeave->endDate = $request->endDate;
        $applyLeave->totalDays = $request->totalDays;
        $applyLeave->details = $request->details;
        $applyLeave->status = 0;
        if($request->hasfile('file')){
            $file = $request->file('file')->getClientOriginalName();
            $folder = $request->file('file')->move(public_path('leave_file').'/',$file);
        }
        else{
            $file = $applyLeave->file;
        }
        $applyLeave->file = $file;
        $applyLeave->save();
        return  redirect()->route('ApplyLeaveList')->with('Update_Message', 'New Apply Leave added successfully');
    }
    public function EmployeeLeaveList(){
        $applyLeaves = ApplyLeave::where('status','1')->get();
        $users = User::all();
        $leaveTypes = LeaveType::all();
        $leavePurposes = LeavePurpose::all();
        return view('Hrm.Leave.ApplyLeave.employeeLeaveList')->with('applyLeaves',$applyLeaves)->with('users',$users)->with('leaveTypes',$leaveTypes)->with('leavePurposes',$leavePurposes);
    }
}
