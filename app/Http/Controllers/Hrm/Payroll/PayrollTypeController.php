<?php

namespace App\Http\Controllers\HRM\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Payroll\PayrollType;
class PayrollTypeController extends Controller
{
    public function addPayrollType(){
        return view('Hrm.Payroll.PayrollType.addPayrollType');
    }
    public function PayrollTypeList(){
        $types = PayrollType::all();
        return view('Hrm.Payroll.PayrollType.payRollTypeList')->with('types',$types);
    }
    public function addPayrollTypePost(Request $request){
        $type = new PayrollType();
        $type->payrollTypeName = $request->name;
        if($request->type==="Percentage"){
            $type->percentage = $request->amount;
        }
        elseif ($request->type==="Tk") {
            $type->tk = $request->amount;
        }
        $type->payrollGenerate = $request->sign;
        $type->save();
        return  redirect()->route('PayrollTypeList')->with('Create_Message', 'Holiday deleted successfully');
    }
    public function payrollTypeInfo(Request $request){
        $type = PayrollType::where('id',$request->id)->first();
        return $type;
    }
    public function payrollTypeDelete(Request $request){
        $type = PayrollType::where('id',$request->id)->delete();
        return  redirect()->route('PayrollTypeList')->with('Delete_Message', 'Holiday deleted successfully');
    }
    public function getPayrollType(Request $request){
        $type = PayrollType::where('id',$request->id)->first();
        return  view('Hrm.Payroll.PayrollType.updatePayrollType')->with('type',$type);
    }
    public function updateTypePost(Request $request){
        $type = PayrollType::where('id',$request->id)->first();
        $type->payrollTypeName = $request->name;
        if($request->type==="Percentage"){
            $type->percentage = $request->amount;
            $type->tk = null;
        }
        elseif ($request->type==="Tk") {
            $type->tk = $request->amount;
            $type->percentage = null;
        }
        $type->payrollGenerate = $request->sign;
        $type->save();
        return  redirect()->route('PayrollTypeList')->with('Update_Message', 'Holiday deleted successfully');
    }
}
