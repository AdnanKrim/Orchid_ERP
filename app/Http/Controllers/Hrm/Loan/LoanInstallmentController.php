<?php

namespace App\Http\Controllers\Hrm\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HRMS\Loan\LoanInstallment;
class LoanInstallmentController extends Controller
{
    public function addLoanInstallmentForm(){
        $user = User::all();
        return view('Hrm.Loan.LoanInstallment.addLoanInstallment')->with('users',$user);
    }
    public function LoanInstallmentList(){
        $user = User::all();
        $loanInstallments = LoanInstallment::all();
        return view('Hrm.Loan.LoanInstallment.loanInstallmentList')->with('users',$user)->with('loanInstallments',$loanInstallments);
    }
    public function addLoanInstallmentPost(Request $request){
        $loanInstallment = new LoanInstallment();
        $loanInstallment->Date = $request->date;
        $loanInstallment->Employee = $request->employee;
        $loanInstallment->InstallmentWithInterest = $request->installmentWithInterest;
        $loanInstallment->ReceivedBy = $request->ReceivedBy;
        $loanInstallment->save();
        return  redirect()->route('LoanInstallmentList')->with('Create_Message', 'Department Addedd Successfully');
    }
    public function getLoanInstallmentInformation(Request $request){
        $loanInstallment = LoanInstallment::where('id',$request->id)->first();
        return $loanInstallment;
    }

    public function deleteLoanInstallment(Request $request){
        $loanInstallment = LoanInstallment::where('id',$request->id)->delete();
        return  redirect()->route('LoanInstallmentList')->with('Delete_Message','Department deleted Successfully');
    }

    public function getLoanInstallment(Request $request){
        $loanInstallment = LoanInstallment::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$loanInstallment->Employee)->first();
        $receivedByName= User::where('id',$loanInstallment->ReceivedBy)->first();
        return view('Hrm.Loan.LoanInstallment.updateLoanInstallment')->with('loanInstallment',$loanInstallment)->with('users',$users)->with('userName',$userName)->with('receivedByName',$receivedByName);
    }
    public function LoanInstallmentUpdate(Request $request){
        $loanInstallment = LoanInstallment::where('id',$request->id)->first();
        $loanInstallment->Date = $request->date;
        $loanInstallment->Employee = $request->employee;
        $loanInstallment->InstallmentWithInterest = $request->installmentWithInterest;
        $loanInstallment->ReceivedBy = $request->ReceivedBy;
        $loanInstallment->save();
        return  redirect()->route('LoanInstallmentList')->with('Update_Message', 'Department Addedd Successfully');
    }
}
