<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountGroup;
use App\Models\Account\AccountType;
use Illuminate\Http\Request;

class AccountGroupController extends Controller
{
    public function addAccountGroup()
    {
        $accountTypes = AccountType::all();
        return view('Account.AccountGroup.addAccountGroup')->with('accountTypes',$accountTypes);
    }
    public function addAccountGroupPost(Request $request)
    {
        $accountGroup = new AccountGroup();
        $accountGroup->AccountType = $request->accType;
        $accountGroup->AccountGroup = $request->group;
        $accountGroup->save();
        return  redirect()->route('AccountGroupList')->with('Create_Message', 'Department Updated Successfully');
    }
    public function AccountGroupList()
    {
        $accountGroups = AccountGroup::all();
        $accountTypes = AccountType::all();
        return view('Account.AccountGroup.accountGroupList')->with('accountGroups',$accountGroups)->with('accountTypes',$accountTypes);
    }
    public function getAccountGroupInformation(Request $request){
        $accountGroups = AccountGroup::where('id',$request->id)->first();
        return $accountGroups;
    }

    public function deleteAccountGroup(Request $request){
        $accountGroups = AccountGroup::where('id',$request->id)->delete();
        return  redirect()->route('AccountGroupList')->with('Delete_Message','Department deleted Successfully');
    }

    public function getAccountGroup(Request $request){
        $accountGroups = AccountGroup::where('id',$request->id)->first();
        $accountTypes = AccountType::all();
        $accountTypeName = AccountType::where('id',$accountGroups->AccountType)->first();
        return view('Account.AccountGroup.updateAccountGroup')->with('accountGroups',$accountGroups)->with('accountTypes',$accountTypes)->with('accountTypeName',$accountTypeName);
    }
    public function updateAccountGroup(Request $request)
    {
        $accountGroup = AccountGroup::where('id',$request->id)->first();
        $accountGroup->AccountType = $request->accType;
        $accountGroup->AccountGroup = $request->group;
        $accountGroup->save();
        return  redirect()->route('AccountGroupList')->with('Update_Message', 'Department Updated Successfully');
    }
    function AccountGroupSearch(Request $req)
    {
        //$accountGroups = AccountGroup::all();
        $accountGroups = AccountGroup::where('AccountGroup', 'like', '%' . $req->input('query') . '%')->get();
        $accountTypes = AccountType::all();
        return view('Account.AccountGroup.searchAccountGroup')->with('accountGroups',$accountGroups)->with('accountTypes',$accountTypes);
    }
}
