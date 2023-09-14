<?php

namespace App\Http\Controllers\Hrm\Other;

use App\Http\Controllers\Controller;
use App\Models\HRMS\Increment;
use App\Models\User;
use Illuminate\Http\Request;

class IncrementController extends Controller
{
    public function addIncrement(){
        $users = User::all();
        return view('Hrm.Others.Increment.addIncrement')->with('users',$users);
    }
    public function addIncrementPost(Request $request){
      $increment = new Increment();
      $increment->Employee = $request->employee;
      $increment->BeforeSalary = $request->beforeSalary;
      $increment->IncrementSalary = $request->incrementAmount;
      $increment->NewSalary = $request->presentSalary;
      $increment->EffectiveDate = $request->effectiveDate;
      $increment->Note = $request->note;
      $increment->IncrementBy = auth()->user()->id;
      $res = $increment->save();
      if($res){
          $user = User::where('id',$request->employee)->first();
          $user->BasicSalary = $request->presentSalary;
          $user->save();
          return  redirect()->route('IncrementList')->with('Create_Message', 'New Complaints added successfully');
      }
    }
    public function IncrementList(){
        $users = User::all();
        $increments = Increment::all();
        return view('Hrm.Others.Increment.IncrementList')->with('users',$users)->with('increments',$increments);
    }
    public function IncrementSearch(Request $request){
        $users = User::all();
        $userName = User::where('name', 'like', '%' . $request->input('query') . '%')->first();
        $increments = Increment::where('employee',$userName->id)->get();
        return view('Hrm.Others.Increment.searchIncrement')->with('users',$users)->with('increments',$increments);
    }
    public function IncrementInfo(Request $request){
        $increments = Increment::where('id',$request->id)->first();
        return $increments;
    }
    public function IncrementDelete(Request $request){
        $increments = Increment::where('id',$request->id)->delete();
        return  redirect()->route('IncrementList')->with('Delete_Message', 'Complaints deleted successfully');
    }
    public function getIncrement(Request $request){
        $increments = Increment::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$increments->Employee)->first();
        return  view('Hrm.Others.Increment.updateIncrement')->with('increments',$increments)->with('users',$users)->with('userName',$userName);
    }
    public function UserSearch(Request $request){
        $users = User::where('id',$request->id)->first();
        return  $users;
    }
    public function updateIncrement(Request $request){
        $increment = Increment::where('id',$request->id)->first();
        $increment->Employee = $request->employee;
        $increment->BeforeSalary = $request->beforeSalary;
        $increment->IncrementSalary = $request->incrementAmount;
        $increment->NewSalary = $request->presentSalary;
        $increment->EffectiveDate = $request->effectiveDate;
        $increment->Note = $request->note;
        $increment->IncrementBy = auth()->user()->id;
        $res = $increment->save();
        if($res){
            $user = User::where('id',$request->employee)->first();
            $user->BasicSalary = $request->presentSalary;
            $user->save();
            return  redirect()->route('IncrementList')->with('Create_Message', 'New Complaints added successfully');
        }
    }
}
