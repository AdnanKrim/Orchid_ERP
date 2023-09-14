<?php

namespace App\Http\Controllers\Hrm;
use App\Models\HRMS\Department;
use App\Models\HRMS\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function designationCreateForm(){
        $dept = Department::all();
        return view('Hrm.Designation.addDesignation')->with('departments',$dept);
    }

    public function designationList(Request $request){
        $designation = Designation::all();
        $dept = Department::all();
        return view('Hrm.Designation.designationList')->with('departments',$dept)->with('designations',$designation);
    }

    public function designationCreate(Request $request){
        $designation = new Designation();
        $designation->designationName = $request->name;
        $designation->departmentId = $request->dept;
        $designation->attendanceType = $request->atype;
        $result = $designation->save();
        if($result){
            return  redirect()->route('designationList')->with('Create_Message', 'Designation Added Successfully');
        }
    }

    public function getDesignationInformation(Request $request){
        $designation = Designation::where('id',$request->id)->first();
        return $designation;
    }

    public function deleteDesignation(Request $request){
        $designation = Designation::where('id',$request->id)->delete();
        return  redirect()->route('designationList')->with('Delete_Message','Designation deleted Successfully');
    }

    public function getDesignation(Request $request){
        $designation = Designation::where('id',$request->id)->first();
        $dept = Department::all();
        $deptName = Department::where('id',$designation->departmentId)->first();
        return view('Hrm.Designation.updateDesignation')->with('designation',$designation)->with('departments',$dept)->with('deptName',$deptName);
    }

    public function updateDesignation(Request $request){
        $designation = Designation::where('id',$request->id)->first();
        $designation->designationName = $request->name;
        $designation->departmentId = $request->dept;
        $designation->attendanceType = $request->atype;
        $result = $designation->save();
        if($result){
            return redirect()->route('designationList')->with('Update_Message','Designation Information Updated Successfully');
        }
    }

    function designationSearch(Request $req)
    {
        $designation = Designation::where('designationName', 'like', '%' . $req->input('query') . '%')->get();
        $dept = Department::all();
        return view('Hrm.Designation.searchDesignation')->with('designations',$designation)->with('departments',$dept);
    }
}
