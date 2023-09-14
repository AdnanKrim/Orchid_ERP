<?php

namespace App\Http\Controllers\Hrm\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Payroll\PayrollType;
use App\Models\HRMS\Payroll\PayrollGenerate;
use App\Models\HRMS\Department;
use App\Models\HRMS\Designation;
use App\Models\Settings\CompanyInfo;
use App\Models\User;
class PayrollGenerateController extends Controller
{
    public function addPayrollGenerate(){
        $users = User::all();
        $payrollTypes = PayrollType::all();
        return view('Hrm.Payroll.PayrollGenerate.addPayrollGenerate')->with('users',$users)->with('payrollTypes',$payrollTypes);
    }
    public function addPayrollGeneratePost(Request $request){
        $payrollGenerate = new PayrollGenerate();
        $payrollGenerate->month = $request->month;
        $payrollGenerate->year = $request->year;
        $payrollGenerate->employee = $request->employee;
        $payrollGenerate->salesCommission = $request->commission;
        $payrollGenerate->netSalary = $request->netSal;
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y');
        $payrollGenerate->generateDate = $time;
        $payrollGenerate->status = "unpaid";
        $payrollGenerate->save();
        return  redirect()->route('PayrollGenerateList')->with('Create_Message', 'Holiday deleted successfully');
    }
    public function GetEmployee(Request $request){
        $user = User::where('id',$request->id)->first();
        $department = Department::where('id',$user->departmentId)->first();
        $designation = Designation::where('id',$user->designationId)->first();
        $branch = CompanyInfo::where('id',$department->branchId)->first();
        $employeeType = $designation->attendanceType;
        $salary = $user->BasicSalary;
        return response()->json([
            'user'=>$user,
            'department'=>$department,
            'designation'=>$designation,
            'branch'=>$branch,
            'employeeType'=>$employeeType,
            'salary'=>$salary
        ]);
        //return view('Hrm.Payroll.PayrollGenerate.addPayrollGenerate')->with('users',$users);
    }
    public function payrollType(){
        $payrollTypes = PayrollType::all();
        return $payrollTypes;
    }
    public function PayrollGenerateList(){
        $generates = PayrollGenerate::all();
        $users = User::all();
        return view('Hrm.Payroll.PayrollGenerate.payRollGenerateList')->with('generates',$generates)->with('users',$users);
    }
    public function payrollGenerateInfo(Request $request){
        $generate = PayrollGenerate::where('id',$request->id)->first();
        return $generate;
    }
    public function payrollGenerateDelete(Request $request){
        $generate = PayrollGenerate::where('id',$request->id)->delete();
        return  redirect()->route('PayrollGenerateList')->with('Delete_Message', 'Holiday deleted successfully');
    }
    public function getPayrollGenerate(Request $request){
        $generate = PayrollGenerate::where('id',$request->id)->first();
        $users = User::all();
        $payrollTypes = PayrollType::all();
        return  view('Hrm.Payroll.PayrollGenerate.updatePayrollGenerate')->with('generate',$generate)->with('users',$users)->with('payrollTypes',$payrollTypes);
    }
    public function updatePayrollGenerate(Request $request){
        $payrollGenerate = PayrollGenerate::where('id',$request->id)->first();
        $payrollGenerate->month = $request->month;
        $payrollGenerate->year = $request->year;
        $payrollGenerate->employee = $request->employee;
        $payrollGenerate->salesCommission = $request->commission;
        $payrollGenerate->netSalary = $request->netSal;
        $payrollGenerate->save();
        return  redirect()->route('PayrollGenerateList')->with('Update_Message', 'Holiday deleted successfully');
    }

}
