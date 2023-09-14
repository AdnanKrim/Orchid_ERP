<?php

namespace App\Http\Controllers\Role;
use App\Models\CRM\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function roleCreateForm(){

        return view('Role.addRole');
    }
    public function roleCreateSubmission(Request $request){

        $role = new Role();
        $role->role = $request->name;
        $res = $role->save();
        if($res){
            return redirect()->route('roleList')->with('message', 'Role Added successfully');
        }
        else{
            return redirect()->route('roleList')->with('message', 'Failed to add role');
        }
    }

    public function RoleList(){
        $role = Role::all();
        return view('Role.roleList')->with('role',$role);
    }
    public function getRoleInformation(Request $request){
        $role = Role::where('id',$request->id)->first();
        return $role;
    }

    public function deleteRole(Request $request){
        $roleCheck = Role::where('id',$request->id)->delete();
        return redirect()->route('roleList')->with('message', 'Role Delete successfully');
    }

    public function roleEdit(Request $request){
        $role = Role::where('id',$request->id)->first();

        return view('Role.EditRole')->with('role',$role);
    }
    public function roleEditSubmit(Request $request){
        $role = Role::where('id',$request->id)->first();
        $role->role = $request->name;
        $role->save();

        return  redirect()->route('roleList')->with('message', 'Role Information Updated Successfully');
    }
}
