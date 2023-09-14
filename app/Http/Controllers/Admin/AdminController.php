<?php
//
//namespace App\Http\Controllers\Admin;
////namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use App\Http\Models\UserManagement\User;
//use App\Models\CRM\Role;
//use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;
//use Hash;
//
//class AdminController extends Controller
//{
//public function updateAdminPassword(Request $request){
////        echo "<pre>";
////        $role = Role::where('id',$request->id)->first();
////        echo "<pre>"; print_r($role);die();
////        if($request->isMethod('post')){
////            $data = $request->all();
////             echo "<pre>";
////             print_r($data);die();
////            // Check if current password entered by admin is correct
//  //          if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
////                // Check if new password is matching with confirm password
////                if($data['new_password']==$data['confirm_password']){
////                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
////                    return redirect()->back()->with('Success_message','Your New password is Updated Successfully!');
////                }else{
////                    return redirect()->back()->with('error_message','Your New password is not matched with Confirm Password!');
////
////                }
////            }else{
////                return redirect()->back()->with('error_message','Your Current password is Incorrect!');
////            }
////        }
////        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
//
//   $user = auth()->user();
//    print_r($user);die();
//        return view('Admin.UpdatePassword')->with(compact('user'));
//    }
//    public function updateAdminDetails(){
//        $user = auth()->user();
////    print_r($user);die();
//        return view('Admin.UpdatePassword')->with(compact('user'));
//    }
//    public function checkAdminPassword(Request $request){
//        $data = $request->all();
//        // echo "<pre>";
//        // print_r($data);die;
//        if(Hash::check($data['old_password'],auth()->user()->password)){
//            return "true";
//        }else{
//            return "false";
//        }
//    }
//
//}


namespace App\Http\Controllers\Admin;
//namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CRM\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;

class AdminController extends Controller
{
    public function updateAdminPassword(Request $request)
    {
 //        echo "<pre>";
        $user = auth()->user();
//  print_r($user);die();

        //$adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();


        return view('Admin.UpdatePassword')->with(compact('user'));
    }

    public function updateAdminPassword1(Request $request)
    {


        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>";
//          print_r($data);die();
//            $f = auth()->user()->id;
//            print_r($f);
//            die();
            // Check if current password entered by admin is correct
            if(Hash::check($data['old_password'],auth()->user()->password)){
                // Check if new password is matching with confirm password
                if($data['new_password']==$data['confirm_password']){
                    User::where('id',auth()->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                   // return redirect()->back()->with('Success_message','Your New password is Updated Successfully!');
                    return redirect('/dashboard')->with('Success_message','Your New password is Updated Successfully!');
                }else{
                    return redirect()->back()->with('error_message','Your New password is not matched with Confirm Password!');

                }
            }else{
                return redirect()->back()->with('error_message','Your Current password is Incorrect!');
            }
        }

    }
    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";
        // print_r($data);die;
        if (Hash::check($data['old_password'], auth()->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }
//  print_r($user);die();
    public function updateAdminDetails(){
       $user = auth()->user();
        return view('Admin.update_admin_details')->with(compact('user'));
    }
    public function updateAdminDetails1(Request $request){
//        $user = User::where('id',auth()->user()->id);
        $user = User::find(auth()->user()->id);
        if ($photo = $request->file('photo')){
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('photo',$fileName,'public');
            $user->photo = '/storage/'.$path;
        }else{
            unset($user['photo']);
        }


        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
        return redirect('/dashboard')->with('Success_message','Profile is Updated Successfully!');
    }
}

