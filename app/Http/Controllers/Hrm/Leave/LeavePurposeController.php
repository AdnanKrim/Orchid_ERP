<?php

namespace App\Http\Controllers\Hrm\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Leave\LeavePurpose;
class LeavePurposeController extends Controller
{
    public function addLeavePurpose(){
        return view('Hrm.Leave.LeavePurpose.addLeavePurpose');
    }
    public function LeavePurposeList(){
        $leavePurposes =LeavePurpose::all();
        return view('Hrm.Leave.LeavePurpose.leavePurposeList')->with('leavePurposes',$leavePurposes);
    }
    public function addLeavePurposePost(Request $request){
        $leavePurpose = new LeavePurpose();
        $leavePurpose->leavePurpose = $request->purpose;
        $leavePurpose->note = $request->note;
        $leavePurpose->save();
        return  redirect()->route('LeavePurposeList')->with('Create_Message', 'New Leave Purpose added successfully');
    }
    public function LeavePurposeInfo(Request $request){
        $leavePurpose = LeavePurpose::where('id',$request->id)->first();
        return $leavePurpose;
    }
    public function LeavePurposeDelete(Request $request){
        $leavePurpose = LeavePurpose::where('id',$request->id)->delete();
        return  redirect()->route('LeavePurposeList')->with('Delete_Message', 'Leave Type deleted successfully');
    }
    public function getLeavePurpose(Request $request){
        $leavePurpose = LeavePurpose::where('id',$request->id)->first();
        return view('Hrm.Leave.LeavePurpose.updateLeavePurpose')->with('leavePurpose',$leavePurpose);
    }
    public function LeavePurposeUpdate(Request $request){
        $leavePurpose = LeavePurpose::where('id',$request->id)->first();
        $leavePurpose->leavePurpose = $request->purpose;
        $leavePurpose->note = $request->note;
        $leavePurpose->save();
        return  redirect()->route('LeavePurposeList')->with('Update_Message', 'New Leave Purpose added successfully');
    }
}
