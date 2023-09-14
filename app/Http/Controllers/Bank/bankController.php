<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank\Bank;
use Illuminate\Http\Request;

class bankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addBank()
    {
        return view('Bank.Bank.addBank');
    }
    public function createBank(Request $request)
    {
        $bank = new Bank();
        $bank->name = $request->name;
        $bank->accName = $request->accName;
        $bank->accNo = $request->accNo;
        $bank->branch = $request->branch;
        $bank->note = $request->note;
        $bank->save();
        return redirect('all-bank')->with('message','New Bank Info Created Successfully!');
    }
    public function allBank(Request $request)
    {
        $banks = Bank::all();
        return view('Bank.bank.allBank',['banks'=>$banks]);
    }
    public function editBank($id)
    {
        $bank = Bank::where('id',$id)->first();
        return view('Bank.bank.editBank',['bank'=>$bank]);
    }
    public function updateBank(Request $request, $id)
    {
        $bank = Bank::where('id',$id)->first();
        $bank->name = $request->name;
        $bank->accName = $request->accName;
        $bank->accNo = $request->accNo;
        $bank->branch = $request->branch;
        $bank->note = $request->note;
        $bank->save();
        return redirect('all-bank')->with('message','New Bank Info Updated Successfully!');
    }
    public function deleteBank($id)
    {
        $bank = Bank::where('id',$id)->first();
        $bank->delete();
        return redirect('all-bank')->with('message','New Bank Info Deleted Successfully!');
    }
}
