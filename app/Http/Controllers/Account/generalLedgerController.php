<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountChart;
use App\Models\Account\AccountGroup;
use App\Models\Account\AccountType;
use App\Models\Account\JournalEntryValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class generalLedgerController extends Controller
{
    public function generalLedgerList()
    {
        $charts = AccountChart::all();
        $accountGroups = AccountGroup::all();
        $accountTypes = AccountType::all();
        return view('Account.GeneralLedger.generalLedgerList')->with('charts',$charts)->with('accountGroups',$accountGroups)->with('accountTypes',$accountTypes);
    }
    public function receivableList(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $today = date("Y-m-d");
       $prevDate = Date('Y-m-d', strtotime('-7 days'));

        $journals = DB::table('journal_entry_values')
            ->where('chartOfAccountId',$request->id)
            ->whereBetween('date',[$prevDate,$today ])
            ->join('journal_entries','journal_entry_values.journalEntryId', '=', 'journal_entries.id')
            ->select('journal_entries.date','journal_entries.JVNo','journal_entry_values.debit','journal_entry_values.credit','journal_entry_values.chartOfAccountId')
            ->get();
        $chart = AccountChart::where('id',$request->id)->first();
        $otherjournals = DB::table('journal_entry_values')
            ->where('chartOfAccountId','<>',$request->id)
            ->join('journal_entries','journal_entry_values.journalEntryId', '=', 'journal_entries.id')
            ->select('journal_entries.date','journal_entry_values.chartOfAccountId')
            ->distinct()
            ->get();
        $allCharts = AccountChart::all();

        return view('Account.GeneralLedger.receivableList')->with('journals',$journals)->with('debit',$journals->sum('debit'))->with('credit',$journals->sum('credit'))->with('chart',$chart)->with('otherjournals',$otherjournals)->with('allCharts',$allCharts);
    }
    public function filterReceivableList(Request $request)
    {
        $journals = DB::table('journal_entry_values')
            ->where('chartOfAccountId',$request->id)
            ->whereBetween('date',[$request->from,$request->to])
            ->join('journal_entries','journal_entry_values.journalEntryId', '=', 'journal_entries.id')
            ->select('journal_entries.date','journal_entries.JVNo','journal_entry_values.debit','journal_entry_values.credit','journal_entry_values.chartOfAccountId')
            ->get();
        $chart = AccountChart::where('id',$request->id)->first();
        $otherjournals = DB::table('journal_entry_values')
            ->where('chartOfAccountId','<>',$request->id)
            ->join('journal_entries','journal_entry_values.journalEntryId', '=', 'journal_entries.id')
            ->select('journal_entries.date','journal_entry_values.chartOfAccountId')
            ->distinct()
            ->get();
        $allCharts = AccountChart::all();

        return view('Account.GeneralLedger.filterReceivableList')->with('journals',$journals)->with('debit',$journals->sum('debit'))->with('credit',$journals->sum('credit'))->with('chart',$chart)->with('otherjournals',$otherjournals)->with('allCharts',$allCharts);
    }
}
