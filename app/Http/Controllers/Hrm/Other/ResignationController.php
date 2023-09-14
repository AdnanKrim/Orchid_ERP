<?php

namespace App\Http\Controllers\Hrm\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Resignation;
use App\Models\User;
class ResignationController extends Controller
{
    public function addResignation(){
        $users = User::all();
        return view('Hrm.Others.Resignation.addResignation')->with('users',$users);
    }
    public function addResignationPost(Request $request){
        $resignation = new Resignation();
        $resignation->Employee = $request->employee;
        $resignation->NoticeDate = $request->ndate;
        $resignation->ResignationDate = $request->rdate;
        $resignation->Description = $request->description;
        $resignation->save();
        return  redirect()->route('ResignationList')->with('Create_Message', 'New Resignation added successfully');
    }
    public function ResignationList(){
        $resignations = Resignation::all();
        $users = User::all();
        return view('Hrm.Others.Resignation.resignationList')->with('resignations',$resignations)->with('users',$users);
    }
    public function resignationInfo(Request $request){
        $resignation = Resignation::where('id',$request->id)->first();
        return $resignation;
    }
    public function resignationDelete(Request $request){
        $resignation = Resignation::where('id',$request->id)->delete();
        return  redirect()->route('ResignationList')->with('Delete_Message', 'New FundTransfer deleted successfully');
    }
    public function getResignation(Request $request){
        $resignation = Resignation::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$resignation->Employee)->first();
        return  view('Hrm.Others.Resignation.updateResignation')->with('resignation',$resignation)->with('users',$users)->with('userName',$userName);
    }
    public function updateResignation(Request $request){
        $resignation = Resignation::where('id',$request->id)->first();
        $resignation->Employee = $request->employee;
        $resignation->NoticeDate = $request->ndate;
        $resignation->ResignationDate = $request->rdate;
        $resignation->Description = $request->description;
        $resignation->save();
        return  redirect()->route('ResignationList')->with('Update_Message', 'New Resignation added successfully');
    }
}
