<?php

namespace App\Http\Controllers\Hrm\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HRMS\Payroll\AdvanceSalary;
use App\Models\HRMS\Department;
use App\Models\HRMS\Designation;
class AdvanceSalaryController extends Controller
{
    public function CreateAdvanceSalary(){
        $users = User::all();
        return view('Hrm.Payroll.AdvanceSalary.addAdvanceSalary')->with('users',$users);
    }
    public function advanceSalaryList(){
        $salaries = AdvanceSalary::all();
        $users = User::all();
        $departments = Department::all();
        $designations = Designation::all();
        return view('Hrm.Payroll.AdvanceSalary.AdvanceSalaryList')->with('salaries',$salaries)->with('users',$users)->with('departments',$departments)->with('designations',$designations);
    }
    public function AdvanceSalaryPost(Request $request){
        $validate = $request->validate([
            "employee" => "required",
            'amount' => 'required',
        ]);
        $salary = new AdvanceSalary();
        $salary->Employee = $request->employee;
        $salary->Amount = $request->amount;
        $salary->Month = $request->salMonth;
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y');
        $salary->Date = $time;
        $salary->save();
        return  redirect()->route('advanceSalaryList')->with('Create_Message', 'advance SalaryList Created successfully');
    }
    public function AdvanceSalaryInfo(Request $request){
        $salary = AdvanceSalary::where('id',$request->id)->first();
        return $salary;
    }
    public function AdvanceSalaryDelete(Request $request){
        $salary = AdvanceSalary::where('id',$request->id)->delete();
        return  redirect()->route('advanceSalaryList')->with('Delete_Message', 'Holiday deleted successfully');
    }
    public function getAdvanceSalary(Request $request){
        $salary = AdvanceSalary::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$salary->Employee)->first();
        return  view('Hrm.Payroll.AdvanceSalary.updateAdvanceSalary')->with('salary',$salary)->with('users',$users)->with('userName',$userName);
    }
    public function AdvanceSalaryUpdate(Request $request){
        $validate = $request->validate([
            "employee" => "required",
            'amount' => 'required',
        ]);
        $salary = AdvanceSalary::where('id',$request->id)->first();
        $salary->Employee = $request->employee;
        $salary->Amount = $request->amount;
        $salary->Month = $request->salMonth;
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y');
        $salary->Date = $time;
        $salary->save();
        return  redirect()->route('advanceSalaryList')->with('Update_Message', 'advance SalaryList Created successfully');
    }
}
