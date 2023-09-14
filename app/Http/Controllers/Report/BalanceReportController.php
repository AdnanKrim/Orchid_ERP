<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountChart;
use Illuminate\Http\Request;

class BalanceReportController extends Controller
{
    public function balanceReport()
    {
        $charts = AccountChart::all();
        return view('Report.balanceReport')->with('charts',$charts);
    }
    public function filterBalancereport(Request $request)
    {
        $charts = AccountChart::whereBetween('Date',[$request->from,$request->to])->get();
        return view('Report.balanceReport')->with('charts',$charts);
    }
}
