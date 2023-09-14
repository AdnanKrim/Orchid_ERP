<?php

namespace App\Http\Controllers\Account\JournalEntry;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountChart;
use App\Models\Account\adjustingJournalEntry;
use App\Models\Account\adjustingJournalEntryValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdjustingJournalController extends Controller
{
    public function addadjustingJournal()
    {
        return view('Account.JournalEntry.AdjustingJournalEntry.addAdjustingJournal');
    }
    public function addadjustingJournalPost(Request $request)
    {
        $journalEntrys = new adjustingJournalEntry();
        $journalEntrys->externalId = $request->externalId;
        $journalEntrys->date = $request->date;
        $journalEntrys->transactionType = $request->transactionType;
        $journalEntrys->description = $request->description;
        $journalEntrys->JVNo = "JV-".rand(1000,9999);
        $journalEntrys->journalType = "Adjusting";

        $res = $journalEntrys->save();
        if ($res){
            $account = json_decode(json_encode($request->account));
            for ($i=0; $i < count($account); $i++) {
                $journalEntrysValue = new adjustingJournalEntryValue();
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
    public function adjustingJournalList()
    {

        $journalValuesCount = adjustingJournalEntryValue::select('journalEntryId', DB::raw("count(*) as count"))->groupBy('journalEntryId')->get();
        $journalValues = adjustingJournalEntryValue::all();
        $jounrals = adjustingJournalEntry::all();
        $accounts = AccountChart::all();
        return view('Account.JournalEntry.AdjustingJournalEntry.adjustingJournalList')->with('journalValuesCount',$journalValuesCount)->with('journalValues',$journalValues)->with('jounrals',$jounrals)->with('accounts',$accounts);
    }
    public function getAdjustingJournal(Request $request){
        $jounrals = adjustingJournalEntry::where('id',$request->id)->first();
        return $jounrals;
    }

    public function deleteAdjustingJournal(Request $request){
        $jounrals = adjustingJournalEntry::where('id',$request->id)->delete();
        $journalValues = adjustingJournalEntryValue::where('journalEntryId',$request->id)->delete();
        return  redirect()->route('adjustingJournalList')->with('Delete_Message','Department deleted Successfully');
    }
}
