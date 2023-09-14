<?php

namespace App\Http\Controllers\Hrm\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Termination;
use App\Models\User;
class TerminationController extends Controller
{
    public function addTermination(){
        $users = User::all();
        return view('Hrm.Others.Termination.addTermination')->with('users',$users);
    }
    public function TerminationList(){
        $terminations =Termination::all();
        $users = User::all();
        return view('Hrm.Others.Termination.terminationList')->with('terminations',$terminations)->with('users',$users);
    }
    public function addTerminationPost(Request $request){
        $termination = new Termination();
        $termination->Employee = $request->employee;
        $termination->Type = $request->type;
        $termination->NoticeDate  = $request->ndate;
        $termination->TerminationDate = $request->tdate;
        $termination->Description = $request->description;
        $termination->save();
        return  redirect()->route('TerminationList')->with('Create_Message', 'New Termination added successfully');
    }
    public function terminationInfo(Request $request){
        $termination = Termination::where('id',$request->id)->first();
        return $termination;
    }
    public function terminationDelete(Request $request){
        $termination = Termination::where('id',$request->id)->delete();
        return  redirect()->route('TerminationList')->with('Delete_Message', 'Complaints deleted successfully');
    }
    public function getTermination(Request $request){
        $termination = Termination::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$termination->Employee)->first();
        return  view('Hrm.Others.Termination.updateTermination')->with('termination',$termination)->with('users',$users)->with('userName',$userName);
    }
    public function updateTermination(Request $request){
        $termination = Termination::where('id',$request->id)->first();
        $termination->Employee = $request->employee;
        $termination->Type = $request->type;
        $termination->NoticeDate  = $request->ndate;
        $termination->TerminationDate = $request->tdate;
        $termination->Description = $request->description;
        $termination->save();
        return  redirect()->route('TerminationList')->with('Update_Message', 'New Termination added successfully');
    }

}
