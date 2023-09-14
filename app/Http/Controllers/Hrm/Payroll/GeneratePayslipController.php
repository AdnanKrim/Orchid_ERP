<?php

namespace App\Http\Controllers\Hrm\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HRMS\Department;
use App\Models\HRMS\Designation;
use App\Models\HRMS\Payroll\PayrollGenerate;
use App\Models\HRMS\Payroll\GeneratePayslip;
class GeneratePayslipController extends Controller
{
    public function GeneratePayslip(){
        $users = User::all();
        return view('Hrm.Payroll.Payslip.addPayslip')->with('users',$users);
    }
    public function GeneratePayslipPost(Request $request){
        $payslip = new GeneratePayslip();
        $payslip->generateId = $request->id;
        $payslip->paymentMethod = $request->method;
        $payslip->comment = $request->comment;
        $result = $payslip->save();
        if ($result) {
            $generate = PayrollGenerate::where('id',$request->id)->first();
            $generate->status = "Paid";
            $generate->save();
            return  redirect()->route('GeneratePayslip')->with('Create_Message', 'Holiday deleted successfully');
        }
    }
    public function slipSearch(Request $request){
        $generate = PayrollGenerate::where('employee',$request->employee)->where('month',$request->month)->where('year',$request->year)->get();
       $user = User::where('id',$request->employee)->first();
        $department = Department::where('id',$user->departmentId)->first();
        $designation = Designation::where('id',$user->designationId)->first();
        return response()->json([
            'user'=>$user,
            'department'=>$department,
            'designation'=>$designation,
            'generate'=>$generate
        ]);
    }
}
