<?php

namespace App\Http\Controllers\Hrm\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HRMS\Loan\GrantLoan;
class GrantLoanController extends Controller
{
    public function addGrantLoanForm(){
        $user = User::all();
        return view('Hrm.Loan.GrantLoan.addGrantLoan')->with('users',$user);
    }
    public function addGrantLoanPost(Request $request){
        $grantLoan = new GrantLoan();
        $grantLoan->Employee = $request->employee;
        $grantLoan->LoanAmount = $request->loanAmount;
        $grantLoan->LoanDetails = $request->loanDetails;
        $grantLoan->InterestPercentage = $request->interestPercentage;
        $grantLoan->InstallmentPeriod = $request->installmentPeriod;
        $grantLoan->TotalInterestAmount = $request->totalInterest;
        $grantLoan->TotalRepayment = $request->totalRepayment;
        $grantLoan->RepaymentFrom = $request->repaymentFrom;
        $grantLoan->PermittedBy = $request->permittedBy;
        $grantLoan->save();
        return  redirect()->route('GrantLoanList')->with('Create_Message', 'Department Addedd Successfully');
    }
    public function GrantLoanList(){
        $user = User::all();
        $grantLoans = GrantLoan::all();
        return view('Hrm.Loan.GrantLoan.grantLoanList')->with('users',$user)->with('grantLoans',$grantLoans);
    }

   public function getGrantLoanInformation(Request $request){
        $grantLoan = GrantLoan::where('id',$request->id)->first();
        return $grantLoan;
    }

    public function deleteGrantLoan(Request $request){
        $grantLoan = GrantLoan::where('id',$request->id)->delete();
        return  redirect()->route('GrantLoanList')->with('Delete_Message','Department deleted Successfully');
    }

    public function getGrantLoan(Request $request){
        $grantLoan = GrantLoan::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$grantLoan->Employee)->first();
        $permittedByName= User::where('id',$grantLoan->PermittedBy)->first();
        return view('Hrm.Loan.GrantLoan.updateGrantLoan')->with('grantLoan',$grantLoan)->with('users',$users)->with('userName',$userName)->with('permittedByName',$permittedByName);
    }
    public function GrantLoanUpdate(Request $request){
        $grantLoan = GrantLoan::where('id',$request->id)->first();
        $grantLoan->Employee = $request->employee;
        $grantLoan->LoanAmount = $request->loanAmount;
        $grantLoan->LoanDetails = $request->loanDetails;
        $grantLoan->InterestPercentage = $request->interestPercentage;
        $grantLoan->InstallmentPeriod = $request->installmentPeriod;
        $grantLoan->TotalInterestAmount = $request->totalInterest;
        $grantLoan->TotalRepayment = $request->totalRepayment;
        $grantLoan->RepaymentFrom = $request->repaymentFrom;
        $grantLoan->PermittedBy = $request->permittedBy;
        $grantLoan->save();
        return  redirect()->route('GrantLoanList')->with('Update_Message', 'Department Addedd Successfully');
    }
}
