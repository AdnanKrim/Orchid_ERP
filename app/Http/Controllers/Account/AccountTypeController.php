<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    public function allAccountType()
    {
        $accountTypes = AccountType::all();
        return view('Account.AccountType.accountTypeList')->with('accountTypes',$accountTypes);
    }
    public function getAccountType(Request $request)
    {
        $accountType = AccountType::where('id',$request->id)->first();
        return view('Account.AccountType.updateAccountType')->with('accountType',$accountType);
    }
    public function  updateAccountType(Request $request){
        $accountType = AccountType::where('id',$request->id)->first();
        $accountType->AccountType = $request->type;
        $accountType->save();
        return  redirect()->route('allAccountType')->with('Update_Message', 'New Apply Leave added successfully');
    }
}
