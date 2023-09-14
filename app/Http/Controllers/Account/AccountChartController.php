<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountChart;
use App\Models\Account\AccountGroup;
use App\Models\Account\AccountType;
use Illuminate\Http\Request;

class AccountChartController extends Controller
{
    public function addAccountChart()
    {
        $accountTypes = AccountType::all();
        return view('Account.AccountChart.addAccountChart')->with('accountTypes',$accountTypes);
    }
    public function addAccountChartPost(Request $request)
    {
        $accountChart = new AccountChart();
        $accountChart->AccountType = $request->accType;
        $accountChart->AccountGroup = $request->accGroup;
        $accountChart->AccountName = $request->name;
        $accountChart->AccountCode = $request->code;
        $accountChart->Balance = $request->balance;
        $accountChart->Date = $request->date;
        $accountChart->Side = $request->side;
        $accountChart->save();
        return  "Successful";
    }
    public function AccountChartList()
    {
        $charts = AccountChart::all();
        $accountGroups = AccountGroup::all();
        $accountTypes = AccountType::all();
        return view('Account.AccountChart.accountChartList')->with('charts',$charts)->with('accountGroups',$accountGroups)->with('accountTypes',$accountTypes);
    }
    public function getAccountChartInformation(Request $request){
        $charts = AccountChart::where('id',$request->id)->first();
        return $charts;
    }

    public function deleteAccountChart(Request $request){
        $charts = AccountChart::where('id',$request->id)->delete();
        return  redirect()->route('AccountChartList')->with('Delete_Message','Department deleted Successfully');
    }
    function AccountChartSearch(Request $req)
    {
        //$accountGroups = AccountGroup::all();
        $charts = AccountChart::where('AccountName', 'like', '%' . $req->input('query') . '%')->get();
        $accountTypes = AccountType::all();
        $accountGroups = AccountGroup::all();
        return view('Account.AccountChart.searchAccountChart')->with('accountGroups',$accountGroups)->with('accountTypes',$accountTypes)->with('charts',$charts);
    }
    public function getAccountChart(Request $request){
        $charts = AccountChart::where('id',$request->id)->first();
        $accountTypes = AccountType::all();
        $accountTypeName = AccountType::where('id',$charts->AccountType)->first();
        $accountGroups = AccountGroup::all();
        $accountGroupName = AccountGroup::where('id',$charts->AccountGroup)->first();

        return view('Account.AccountChart.updateAccountChart')->with('charts',$charts)->with('accountTypes',$accountTypes)->with('accountTypeName',$accountTypeName)->with('accountGroups',$accountGroups)->with('accountGroupName',$accountGroupName);
    }
    public function updateAccountChart(Request $request)
    {
        $accountChart = AccountChart::where('id',$request->id)->first();
        $accountChart->AccountType = $request->accType;
        $accountChart->AccountGroup = $request->accGroup;
        $accountChart->AccountName = $request->name;
        $accountChart->AccountCode = $request->code;
        $accountChart->Balance = $request->balance;
        $accountChart->Date = $request->date;
        $accountChart->Side = $request->side;
        $accountChart->save();
        return  redirect()->route('AccountChartList')->with('Update_Message', 'Department Updated Successfully');
    }
    public function getAccountType(){
        $types = AccountType::all();
        return $types;
    }
    public function getAccountGroup(Request $request){
        $groups = AccountGroup::where('AccountType',$request->type)->get();
        return $groups;
    }
}
