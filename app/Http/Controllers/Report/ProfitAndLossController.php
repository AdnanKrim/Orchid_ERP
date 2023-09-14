<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountChart;
use App\Models\Account\AccountGroup;
use App\Models\Account\AccountType;
use Illuminate\Http\Request;

class ProfitAndLossController extends Controller
{
    public function profitAndLossReport()
    {
        $types = AccountType::all();
        $groups = AccountGroup::all();
        $charts = AccountChart::all();
        return view('Report.profitAndLoss')->with('charts',$charts)->with('types',$types)->with('groups',$groups);
    }
    public function FilterprofitAndLossReport(Request $request)
    {
        $types = AccountType::all();
        $groups = AccountGroup::all();
        $charts = AccountChart::whereBetween('Date',[$request->from,$request->to])->get();
        return view('Report.profitAndLoss')->with('charts',$charts)->with('types',$types)->with('groups',$groups);
    }
}
