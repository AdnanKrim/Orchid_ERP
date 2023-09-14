<?php

namespace App\Http\Controllers\Hrm\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Complaints;
use App\Models\User;
class ComplaintsController extends Controller
{
    public function addComplaint(){
        $users = User::all();
        return view('Hrm.Others.Complaints.addComplaints')->with('users',$users);
    }
    public function ComplaintsList(){
        $complaints = Complaints::all();
        $users = User::all();
        return view('Hrm.Others.Complaints.complaintsList')->with('complaints',$complaints)->with('users',$users);
    }
    public function addComplaintPost(Request $request){
        $complaints = new Complaints();
        $complaints->FromEmployee = $request->fromEmployee;
        $complaints->Title = $request->title;
        $complaints->ComplaintDate = $request->cdate;
        $complaints->ToEmployee = $request->toEmployee;
        $complaints->Description = $request->description;
        $complaints->save();
        return  redirect()->route('ComplaintsList')->with('Create_Message', 'New Complaints added successfully');
    }
    public function complaintInfo(Request $request){
        $complaint = Complaints::where('id',$request->id)->first();
        return $complaint;
    }
    public function complaintDelete(Request $request){
        $complaint = Complaints::where('id',$request->id)->delete();
        return  redirect()->route('ComplaintsList')->with('Delete_Message', 'Complaints deleted successfully');
    }
    public function getComplaint(Request $request){
        $complaint = Complaints::where('id',$request->id)->first();
        $users = User::all();
        $fromUser = User::where('id',$complaint->FromEmployee)->first();
        $toUser = User::where('id',$complaint->ToEmployee)->first();
        return  view('Hrm.Others.Complaints.updateComplaint')->with('complaint',$complaint)->with('users',$users)->with('fromUser',$fromUser)->with('toUser',$toUser);
    }
    public function updateComplaint(Request $request){
        $complaints = Complaints::where('id',$request->id)->first();
        $complaints->FromEmployee = $request->fromEmployee;
        $complaints->Title = $request->title;
        $complaints->ComplaintDate = $request->cdate;
        $complaints->ToEmployee = $request->toEmployee;
        $complaints->Description = $request->description;
        $complaints->save();
        return  redirect()->route('ComplaintsList')->with('Update_Message', 'New Complaints added successfully');
    }
}
