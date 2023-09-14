<?php

namespace App\Http\Controllers\Hrm\Shift;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Shift\HrmShift;
use App\Models\HRMS\Shift\ShiftSchedule;
use App\Models\HRMS\Shift\DefaultOffDay;
class ShiftController extends Controller
{
    public function addShift(){
        return view('Hrm.Shift.addShift');
    }
    public function addShiftPost(Request $request){
        $shift = new HrmShift();
        $shift->shiftName = $request->shiftName;
        $res = $shift->save();
        if($res){
            return  redirect()->route('ShiftList')->with('Create_Message', 'Department Addedd Successfully');
        }
    }
    public function ShiftList(){
        $shifts = HrmShift::all();
        //return $shifts;
        return view('Hrm.Shift.shiftList')->with('shifts',$shifts);
    }
    public function getShiftInformation(Request $request){
        $shift = HrmShift::where('id',$request->id)->first();
        return $shift;
    }

    public function deleteShift(Request $request){
        $shift = HrmShift::where('id',$request->id)->delete();
        return  redirect()->route('ShiftList')->with('Delete_Message','Department deleted Successfully');
    }
    public function getShift(Request $request){
        $shift = HrmShift::where('id',$request->id)->first();
        return view('Hrm.Shift.updateShift')->with('shift',$shift);
    }
    public function updateShift(Request $request){
        $shift = HrmShift::where('id',$request->id)->first();
        $shift->shiftName = $request->shiftName;
        $res = $shift->save();
        if($res){
            return  redirect()->route('ShiftList')->with('Update_Message', 'Department Addedd Successfully');
        }
    }
//Shift Schedule---------------------------------
    public function addShiftSchedule(){
        $shifts = HrmShift::all();
        return view('Hrm.Shift.ShiftSchedule.addShiftSchedule')->with('shifts',$shifts);
    }
    public function ShiftScheduleList(){
        $shifts = ShiftSchedule::all();
        $days = DefaultOffDay::all();
        return view('Hrm.Shift.ShiftSchedule.shiftScheduleList')->with('shifts',$shifts)->with('days',$days);
    }
    public function addShiftSchedulePost(Request $request){
        $scheduleCheck = ShiftSchedule::where('shiftName',$request->shiftName)->first();
        if($scheduleCheck){
            if(empty($scheduleCheck->time)){
                $data[] = array('dayName' => $request->dayName , 'inTime' => $request->inTime , 'outTime' => $request->outTime);
            }
            else{
                $datas = json_decode($scheduleCheck->time);
                foreach ($datas as $data) {
                    if($data->dayName === $request->dayName){
                        return  redirect()->route('ShiftScheduleList')->with('Error_Message', 'Department Addedd Successfully');
                    }
                }
                array_push($datas,array('dayName' => $request->dayName , 'inTime' => $request->inTime , 'outTime' => $request->outTime));
            }
            $data_encode = json_encode($datas);
            $scheduleCheck->time = $data_encode;
            $res = $scheduleCheck->save();
            if($res){
                return  redirect()->route('ShiftScheduleList')->with('Create_Message', 'Department Addedd Successfully');
            }
        }
        else{
        $shift = new ShiftSchedule();
        $shift->shiftName = $request->shiftName;
        $data[] = array('dayName' => $request->dayName , 'inTime' => $request->inTime , 'outTime' => $request->outTime);
        $data_encode = json_encode($data);
        $shift->time = $data_encode;
        $res = $shift->save();
        if($res){
            return  redirect()->route('ShiftScheduleList')->with('Create_Message', 'Department Addedd Successfully');
        }
    }
    }
    public function getShiftScheduleInformation(Request $request){
        $shift = ShiftSchedule::where('id',$request->id)->first();
        return $shift;
    }

    public function deleteShiftSchedule(Request $request){
        $shift = ShiftSchedule::where('id',$request->id)->delete();
        return  redirect()->route('ShiftScheduleList')->with('Delete_Message','Department deleted Successfully');
    }
    public function getShiftSchedule(Request $request){
        $shift = ShiftSchedule::where('id',$request->id)->first();
        $shifts = HrmShift::all();
        $shiftName = HrmShift::where('shiftName',$shift->shiftName)->first();
        return view('Hrm.Shift.ShiftSchedule.updateShiftSchedule')->with('shift',$shift)->with('shifts',$shifts)->with('shiftName',$shiftName);
    }
    public function updateShiftSchedule(Request $request){
        $shift = ShiftSchedule::where('id',$request->id)->first();
        $shift->shiftName = $request->shiftName;
        $shift->friTime = json_encode($request->friTime);
        $shift->satTime = json_encode($request->satTime);
        $shift->sunTime = json_encode($request->sunTime);
        $shift->monTime = json_encode($request->monTime);
        $shift->tuesTime = json_encode($request->tuesTime);
        $shift->wedTime = json_encode($request->wedTime);
        $shift->thuTime = json_encode($request->thuTime);
        $res = $shift->save();
        if($res){
            return  redirect()->route('ShiftList')->with('Update_Message', 'Department Addedd Successfully');
        }
    }

    //default off day-----------------------

    public function addDefaultOffDay(){
        return view('Hrm.Shift.DefaultOffDay.addDefaultOffday');
    }
    public function addDefaultOffDayPost(Request $request){
        $days = DefaultOffDay::where('dayName',$request->dayName)->first();
        if($days){
            return  redirect()->route('offDayList')->with('Error_Message', 'Department Addedd Successfully');
        }
        else{
        $offDay = new DefaultOffDay();
        $offDay->dayName = $request->dayName;
        $offDay->offDay = $request->offDay;
        $offDay->save();
        return  redirect()->route('offDayList')->with('Create_Message', 'Department Addedd Successfully');
        }
    }
    public function offDayList(){
        $days = DefaultOffDay::all();
        return view('Hrm.Shift.DefaultOffDay.offDayList')->with('days',$days);
    }
    public function getoffDayInformation(Request $request){
        $days = DefaultOffDay::where('id',$request->id)->first();
        return $days;
    }

    public function deleteoffDay(Request $request){
        $days = DefaultOffDay::where('id',$request->id)->delete();
        return  redirect()->route('offDayList')->with('Delete_Message','Department deleted Successfully');
    }
    public function getoffDay(Request $request){
        $day = DefaultOffDay::where('id',$request->id)->first();
        return view('Hrm.Shift.DefaultOffDay.updateOffDay')->with('day',$day);
    }
    public function updateDefaultOffDayPost(Request $request){
        $offDay = DefaultOffDay::where('id',$request->id)->first();
        $offDay->dayName = $request->dayName;
        $offDay->offDay = $request->offDay;
        $offDay->save();
        return  redirect()->route('offDayList')->with('Update_Message', 'Department Addedd Successfully');
    }
}
