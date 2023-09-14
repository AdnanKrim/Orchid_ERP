<?php

namespace App\Http\Controllers\Hrm\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Leave\LeaveType;
class LeaveTypeController extends Controller
{
    public function addLeaveType(){
        return view('Hrm.Leave.LeaveType.addLeaveType');
    }
    public function addLeaveTypePost(Request $request){
        $leaveType = new LeaveType();
        $leaveType->leaveType = $request->type;
        $leaveType->NumberOfLeave = $request->numberOfleave;
        $leaveType->MaximumLeave  = $request->maxLeave;
        $leaveType->Status  = $request->status;
        $leaveType->save();
        return  redirect()->route('LeaveTypeList')->with('Create_Message', 'New Leave Type added successfully');
    }
    public function LeaveTypeList(){
        $leaveTypes =LeaveType::all();
        return view('Hrm.Leave.LeaveType.leaveTypeList')->with('leaveTypes',$leaveTypes);
    }
    public function LeaveTypeInfo(Request $request){
        $leaveTypes = LeaveType::where('id',$request->id)->first();
        return $leaveTypes;
    }
    public function LeaveTypeDelete(Request $request){
        $leaveTypes = LeaveType::where('id',$request->id)->delete();
        return  redirect()->route('LeaveTypeList')->with('Delete_Message', 'Leave Type deleted successfully');
    }
    public function getLeaveType(Request $request){
        $leaveTypes = LeaveType::where('id',$request->id)->first();
        return view('Hrm.Leave.LeaveType.updateLeaveType')->with('leaveTypes',$leaveTypes);
    }
    public function LeaveTypeUpdate(Request $request){
        $leaveType = LeaveType::where('id',$request->id)->first();
        $leaveType->leaveType = $request->type;
        $leaveType->NumberOfLeave = $request->numberOfleave;
        $leaveType->MaximumLeave  = $request->maxLeave;
        $leaveType->Status  = $request->status;
        $leaveType->save();
        return  redirect()->route('LeaveTypeList')->with('Update_Message', 'New Leave Type added successfully');
    }
}
