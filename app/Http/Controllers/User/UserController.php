<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use App\Models\CRM\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userCreateForm(){

        $users = User::where('loginIllegible',0)->where('Status',1)->get();
        return view('User.addUser')->with('users',$users);
    }

    public function userCreateSubmit(Request $request){
        $user = User::where('id',$request->user)->first();
        $user->password = bcrypt($request->password);
        $user->loginIllegible = 1;
        if($request->password === $request->cpass){
        $result = $user->save();
        }
        else{
            return  redirect()->route('userList')->with('message', 'Password and Confirm password doesnt match');
        }
        if($result){
            return  redirect()->route('userList')->with('message', 'User Information Updated Successfully');
        }
    }

    public function userList(){
        $user = User::where('loginIllegible',1)->get();
        $role = Role::all();
        return view('User.userList')->with('user',$user)->with('role',$role);
    }
    public function getUserInformation(Request $request){
        $user = User::where('id',$request->id)->first();
        return $user;
    }

    public function deleteUser(Request $request){
        $userCheck = User::where('id',$request->id)->delete();
        return  redirect()->route('userList')->with('message', 'User Information Deleted Successfully');
    }
    public function userEdit(Request $request){
        $user = User::where('id',$request->id)->first();
        $role = Role::all();
        $roleName = Role::where('id',$user->roleId)->first();
        return view('User.editUser')->with('user',$user)->with('role',$role)->with('roleName',$roleName);
    }

    public function userEditSubmit(Request $request){
        $role = Role::where('role',$request->userRole)->first();
        $user = User::where('id',$request->id)->first();
        $user->roleId = $role->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $result = $user->save();
        if($result){
            return  redirect()->route('userList')->with('message', 'User Information Updated Successfully');
        }
        else{
            return  redirect()->route('userList')->with('message', 'User Information Updated Successfully');
        }
    }

    public function userlistApi(){
        $user = User::all();
        return $user;
    }
}
