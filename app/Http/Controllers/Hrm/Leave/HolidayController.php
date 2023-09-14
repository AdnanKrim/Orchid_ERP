<?php

namespace App\Http\Controllers\Hrm\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Leave\Holiday;
class HolidayController extends Controller
{
    public function addHoliday(){
        return view('Hrm.Leave.Holiday.addHoliday');
    }
    public function addHolidayPost(Request $request){
        $holiday = new Holiday();
        $holiday->HolidayName = $request->name;
        $holiday->startDate = $request->startDate;
        $holiday->endDate = $request->endDate;
        $holiday->totalDays = $request->totalDays;
        $holiday->Status = 0;
        $holiday->save();
        return  redirect()->route('holidayList')->with('Create_Message', 'New Holiday added successfully');
    }
    public function holidayList(){
        $holidays = Holiday::all();
        return view('Hrm.Leave.Holiday.holidayList')->with('holidays',$holidays);
    }
    public function statusUpdate(Request $request){
        $holidays = Holiday::where('id',$request->id)->first();
        $holidays->Status = $request->status;
        $holidays->save();
        return "Successfull";
    }
    public function holidayInfo(Request $request){
        $holidays = Holiday::where('id',$request->id)->first();
        return $holidays;
    }
    public function holidayDelete(Request $request){
        $holidays = Holiday::where('id',$request->id)->delete();
        return  redirect()->route('holidayList')->with('Delete_Message', 'Holiday deleted successfully');
    }
    public function getHoliday(Request $request){
        $holidays = Holiday::where('id',$request->id)->first();
        return  view('Hrm.Leave.Holiday.updateHoliday')->with('holidays',$holidays);
    }
    public function updateHoliday(Request $request){
        $holiday = Holiday::where('id',$request->id)->first();
        $holiday->HolidayName = $request->name;
        $holiday->startDate = $request->startDate;
        $holiday->endDate = $request->endDate;
        $holiday->totalDays = $request->totalDays;
        $holiday->save();
        return  redirect()->route('holidayList')->with('Update_Message', 'New Holiday added successfully');
    }
}
