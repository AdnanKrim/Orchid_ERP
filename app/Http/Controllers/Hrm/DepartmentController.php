<?php

namespace App\Http\Controllers\Hrm;

use App\Models\HRMS\Department;
use App\Models\User;
use App\Models\Settings\BusinessBranch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function deptCreateForm(){
        $user = User::all();
        $branch = BusinessBranch::all();
        return view('Hrm.Department.addDept')->with('users',$user)->with('branches',$branch);
    }

    public function deptCreate(Request $request){
        $dept = new Department();
        $dept->departmentName = $request->name;
        $dept->departmentHead = $request->dhead;
        $dept->branchId = $request->branch;
        $result = $dept->save();
        if($result){
            return  redirect()->route('deptList')->with('Create_Message', 'Department Addedd Successfully');
        }
    }

    public function deptList(){
        $departments = Department::all();
        $heads = User::all();
        $branches = BusinessBranch::all();
        return view('Hrm.Department.deptList')->with('departments',$departments)->with('heads',$heads)->with('branches',$branches);
    }

    public function getDeptInformation(Request $request){
        $dept = Department::where('id',$request->id)->first();
        return $dept;
    }

    public function deleteDept(Request $request){
        $dept = Department::where('id',$request->id)->delete();
        return  redirect()->route('deptList')->with('Delete_Message','Department deleted Successfully');
    }

    public function getDept(Request $request){
        $dept = Department::where('id',$request->id)->first();
        $user = User::all();
        $branches = BusinessBranch::all();
        $deptHead = User::where('id',$dept->departmentHead)->first();
        $branchName = BusinessBranch::where('id',$dept->branchId)->first();
        return view('Hrm.Department.updateDept')->with('department',$dept)->with('heads',$user)->with('deptHead',$deptHead)->with('branches',$branches)->with('branchName',$branchName);
    }

   /* public function updateDept(Request $request){
        $dept = Department::where('id',$request->id)->first();
        $dept->departmentName = $request->name;
        $dept->departmentHead = $request->head;
        $dept->branchId = $request->branch;
        $result = $dept->save();
        if($result){
            return redirect()->route('deptList')->with('Update_Message','Department Information Updated Successfully');
        }
    }*/

    function deptSearch(Request $req)
    {
        $departments = Department::where('departmentName', 'like', '%' . $req->input('query') . '%')->get();
        $heads = User::all();
        $branches = CompanyInfo::all();
        return view('Hrm.Department.searchDept')->with('departments',$departments)->with('heads',$heads)->with('branches',$branches);
    }
    public function updateDept(Request $request){
        $dept = Department::where('id',$request->id)->first();
        $dept->departmentName = $request->name;
        $dept->departmentHead = $request->head;
        $dept->branchId = $request->branch;
        $result = $dept->save();
        if($result){
            return  redirect()->route('deptList')->with('Update_Message', 'Department Updated Successfully');
        }
    }
}
