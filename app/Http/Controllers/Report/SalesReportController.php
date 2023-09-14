<?php

namespace App\Http\Controllers\Report;

use App\Models\Report\SalesReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesReports = SalesReport::all();
        return view('Report.salesreport')->with('salesReports', $salesReports);
        // return $salesReports;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Report.create-salesreport');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = new SalesReport();
        $report->date = \Carbon\Carbon::parse($request->date);
        $report->client_name = $request->client_name;
        $report->InvoceNo = $request->InvoiceNo;
        $report->project_name = $request->project_name;
        $report->business_branch = $request->business_branch;
        $report->amount = $request->amount;

        $res = $report->save();
        if($res){
            return redirect()->route('sales-report')->with('message', 'Menu Added successfully');
        }
        else{
            return redirect()->route('sales-report')->with('message', 'Failed to add menu');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function getSalesReport(SalesReport $salesReport)
    {
        $salesReports = SalesReport::all();
        // return view('Report.salesreport')->with('salesReports', $salesReports);
        return $salesReports;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesReport $salesReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesReport $salesReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesReport $salesReport)
    {
        //
    }
}
