<?php

namespace App\Http\Controllers\Account\JournalEntry;

use App\Http\Controllers\Controller;
use App\Models\Account\JournalEntry;
use App\Models\Account\JournalEntryValue;
use Illuminate\Http\Request;
use App\Models\Account\AccountChart;
use Illuminate\Support\Facades\DB;

class GeneralJournalController extends Controller
{
    public function addgeneralJournal()
    {
        return view('Account.JournalEntry.GeneralJournalEntry.addGeneralJournal');
    }
    public function getAccount()
    {
        $accounts = AccountChart::all();
        return $accounts;
    }
    public function addgeneralJournalPost(Request $request)
    {
       $journalEntrys = new JournalEntry();
        $journalEntrys->externalId = $request->externalId;
        $journalEntrys->date = $request->date;
        $journalEntrys->transactionType = $request->transactionType;
        $journalEntrys->description = $request->description;
        $journalEntrys->JVNo = "JV-".rand(1000,9999);
        $journalEntrys->journalType = "General";

        $res = $journalEntrys->save();
        if ($res){
            $account = json_decode(json_encode($request->account));
            for ($i=0; $i < count($account); $i++) {
                $journalEntrysValue = new JournalEntryValue();
                $journalEntrysValue->journalEntryId = $journalEntrys->id;
                $journalEntrysValue->chartOfAccountId = json_decode(json_encode($request->account[$i]));
                $journalEntrysValue->debit = json_decode(json_encode($request->debit[$i]));
                $journalEntrysValue->credit = json_decode(json_encode($request->credit[$i]));
                $save = $journalEntrysValue->save();
                if ($save){

                    $accountChart = AccountChart::where('id',json_decode(json_encode($request->account[$i])))->first();
                    $balance = $accountChart->Balance;
                    if ($accountChart->Side === "Debit"){
                        $balance = $balance + (int) json_decode(json_encode($request->debit[$i]));
                        $balance = $balance - (int) json_decode(json_encode($request->credit[$i]));
                        $accountChart->Balance = $balance;
                        $accountChart->save();
                    }
                    if ($accountChart->Side === "Credit"){
                        $balance = $balance - (int) json_decode(json_encode($request->debit[$i]));
                        $balance = $balance + (int) json_decode(json_encode($request->credit[$i]));
                        $accountChart->Balance = $balance;
                        $accountChart->save();
                    }
                }
            }
        }
        return "Successful";

    }
    public function generalJournalList()
    {

        $journalValuesCount = JournalEntryValue::select('journalEntryId', DB::raw("count(*) as count"))->groupBy('journalEntryId')->get();
        $journalValues = JournalEntryValue::all();
        $jounrals = JournalEntry::all();
        $accounts = AccountChart::all();
        return view('Account.JournalEntry.GeneralJournalEntry.generalJournalList')->with('journalValuesCount',$journalValuesCount)->with('journalValues',$journalValues)->with('jounrals',$jounrals)->with('accounts',$accounts);
    }
    public function getGeneralJournal(Request $request){
        $jounrals = JournalEntry::where('id',$request->id)->first();
        return $jounrals;
    }

    public function deleteGeneralJournal(Request $request){
        $jounrals = JournalEntry::where('id',$request->id)->delete();
        $journalValues = JournalEntryValue::where('journalEntryId',$request->id)->delete();
        return  redirect()->route('generalJournalList')->with('Delete_Message','Department deleted Successfully');
    }
}
