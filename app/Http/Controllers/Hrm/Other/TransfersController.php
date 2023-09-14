<?php

namespace App\Http\Controllers\Hrm\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Transfer;
use App\Models\HRMS\Department;
use App\Models\Settings\CompanyInfo;
use App\Models\User;

class TransfersController extends Controller
{
    public function addTransfer(){
        $users = User::all();
        $branches = CompanyInfo::all();
        $departments = Department::all();
        return view('Hrm.Others.Transfer.addTransfer')->with('users',$users)->with('branches',$branches)->with('departments',$departments);
    }
    public function addTransferPost(Request $request){
        $transfer = new Transfer();
        $transfer->Employee = $request->employee;
        $transfer->TransferDate = $request->tdate;
        $transfer->Department = $request->department;
        $transfer->Location = $request->location;
        $transfer->Description = $request->description;
        $transfer->save();
        return  redirect()->route('transferList')->with('Create_Message', 'New FundTransfer added successfully');
    }
    public function transferList(){
       $transfers = Transfer::all();
       $users = User::all();
       $branches = CompanyInfo::all();
       $departments = Department::all();
       //return $transfers;
    return view('Hrm.Others.Transfer.transferList')->with('transfers',$transfers)->with('users',$users)->with('branches',$branches)->with('departments',$departments);

    }
    public function transferInfo(Request $request){
        $transfers = Transfer::where('id',$request->id)->first();
        return $transfers;
    }
    public function transferDelete(Request $request){
        $transfers = Transfer::where('id',$request->id)->delete();
        return  redirect()->route('transferList')->with('Delete_Message', 'New FundTransfer deleted successfully');
    }
    public function getTransfer(Request $request){
        $transfer = Transfer::where('id',$request->id)->first();
        $users = User::all();
        $branches = CompanyInfo::all();
        $departments = Department::all();
        $userName = User::where('id',$transfer->Employee)->first();
        $branchName = CompanyInfo::where('id',$transfer->Location)->first();
        $departmentName = Department::where('id',$transfer->Department)->first();
        return  view('Hrm.Others.Transfer.updateTransfer')->with('transfer',$transfer)->with('users',$users)->with('branches',$branches)->with('departments',$departments)->with('userName',$userName)->with('branchName',$branchName)->with('departmentName',$departmentName);
    }
    public function UpdateTransfer(Request $request){
        $transfer = Transfer::where('id',$request->id)->first();
        $transfer->Employee = $request->employee;
        $transfer->TransferDate = $request->tdate;
        $transfer->Department = $request->department;
        $transfer->Location = $request->location;
        $transfer->Description = $request->description;
        $transfer->save();
        return  redirect()->route('transferList')->with('Update_Message', 'New FundTransfer added successfully');
    }

}
