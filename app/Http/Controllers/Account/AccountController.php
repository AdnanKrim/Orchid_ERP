<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Account;
use App\Models\Bank\Bank;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>'getBanks']);
    }
    public function addAccount()
    {
        return view('Account.addAccount');
    }
    public function createAccount(Request $request)
    {
        $bank = Bank::where('name',$request->bank)->first();
        $acc = new Account();
        if ($request->has('bank')){
            $accNoBank = $bank->accNo;
        }else{
            $accNoBank = $request->accNo;
        }
        $acc->accName = $request->accName;
        $acc->openingBalance = $request->openingBalance;
        $acc->accType = $request->accType;
        $acc->accNo = $accNoBank;
        $acc->bank = $request->bank;
        $acc->bankAcc = $request->bankAcc;
        $acc->branch = $request->branch;
        $acc->mobileService = $request->mobileService;
        $acc->numberType = $request->numberType;
        $acc->note = $request->note;
        $acc->save();
        return redirect('all-account')->with('message','New Account Created Successfully!');
    }
    public function allAccount()
    {
        $accs = Account::all();
        return view('Account.allAccount',['accs'=>$accs]);
    }
    public function allAccountBalance()
    {
        $accs = Account::all();
        return view('Account.allAccountBalance',['accs'=>$accs]);
    }
    public function getBanks()
    {
        $banks = Bank::all();
        return response()->json($banks);
    }
    public function editAccount($id)
    {
        $acc = Account::where('id',$id)->first();
        return view('Account.editAccount',['acc'=>$acc]);
    }
    public function updateAccount(Request $request, $id)
    {
        $bank = Bank::where('name',$request->bank)->first();
        $acc = Account::where('id',$id)->first();
        if ($request->has('bank')){
            $accNoBank = $bank->accNo;
        }else{
            $accNoBank = $request->accNo;
        }
        $acc->accName = $request->accName;
        $acc->openingBalance = $request->openingBalance;
        $acc->accType = $request->accType;
        $acc->accNo = $accNoBank;
        $acc->bank = $request->bank;
        $acc->bankAcc = $request->bankAcc;
        $acc->branch = $request->branch;
        $acc->mobileService = $request->mobileService;
        $acc->numberType = $request->numberType;
        $acc->note = $request->note;
        $acc->save();
        return redirect('all-account')->with('message','Account Info Updated Successfully!');
    }
    public function deleteAccount($id)
    {
        $acc = Account::where('id',$id)->first();
        $acc->delete();
        return redirect('all-account')->with('message','Account Info Deleted Successfully!');
    }
}
