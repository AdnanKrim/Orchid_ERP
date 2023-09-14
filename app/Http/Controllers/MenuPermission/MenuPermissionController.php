<?php

namespace App\Http\Controllers\MenuPermission;
use App\Models\UserManagement\MenuPermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuPermissionController extends Controller
{

    public function MenuPermitView(){
        return view ('Menu-Permission.menuPermission');
    }
    public function givepermission(Request $request){
        $checkUser = MenuPermission::where('userId',$request->user)->first();
        if($checkUser){
            return response()->json([
                'message'=>'User already get menu permission',
                'status'=>0
            ]);
        }
        else{
        $menuPermission = new MenuPermission();
        $menuPermission->userId = $request->user;
        $menuPermission->menuIds =json_encode($request->menu);
        $menuPermission->subMenuIds =json_encode($request->submenu);
        $menuPermission->subsubMenuIds =json_encode($request->subsubmenu);
        $menuPermission->actions =json_encode($request->action);
        $menuPermission->save();
        return response()->json([
            'message'=>'Menu Permission Given Successfully',
            'status'=>1
        ]);
    }

    }
    public function updatePermission(Request $request, $id){
        $menuPermission = MenuPermission::find($id);
        $menuPermission->userId = $request->user;
        $menuPermission->menuIds =json_encode($request->menu);
        $menuPermission->subMenuIds =json_encode($request->submenu);
        $menuPermission->subsubMenuIds =json_encode($request->subsubmenu);
        $menuPermission->actions =json_encode($request->action);
        $menuPermission->save();
        return "Menu updated successfully";

    }
    public function selectedPermission(){
        $userId = request('userId');
        $selectedPermission = MenuPermission::where('userId',$userId)->get();
        return $selectedPermission;
    }
    public function previousPermission(){
        $selectedPermission = MenuPermission::all();
        return $selectedPermission;
    }
    public function getUserMenuInformation(Request $request){
        $checkUser = MenuPermission::where('userId',$request->user)->first();
        if($checkUser){
            return response()->json([
                'user'=>$checkUser,
                'status'=>1
            ]);
        }
        else{
            return response()->json([
                'message'=>'User already get menu permission',
                'status'=>0
            ]);
        }
    }
}
