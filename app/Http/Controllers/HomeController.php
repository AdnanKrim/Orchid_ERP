<?php

namespace App\Http\Controllers;

use App\Models\UserManagement\MenuPermission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('auth');
    }

    /**[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menuPermissions = MenuPermission::all();
        return view('master.dashboard',compact('menuPermissions'));
    }
    public function log()
    {
        $menuPermissions = MenuPermission::all();
        // $menuIds = json_decode(json_encode($menuPermissions->menuIds),true);
        // dd($menuIds);
        return view('master.dashboard',compact('menuPermissions'));
    }
}
