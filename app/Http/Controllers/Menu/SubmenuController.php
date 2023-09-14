<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserManagement\Menu;
use App\Models\UserManagement\SubMenu;

class SubmenuController extends Controller
{
    public function SubmenuCreateForm(){
        $menu = Menu::all();
     return view('Submenu.addSubmenu')->with('menu',$menu);
    }

    public function SubmenuCreateSubmission(Request $request){

        $menu = Menu::where('menuName',$request->menu)->first();
        $codeCheck = SubMenu::where('code',$request->code)->first();
        if($codeCheck){
            return redirect()->route('SubmenuList')->with('message', 'Code Already exist');
        }
        else{
        $subMenu = new SubMenu();
        $subMenu->menuId = $menu->id;
        $subMenu->subMenuName = $request->name;
        $subMenu->code = $request->code;
        $res = $subMenu->save();
        if($res){
            return redirect()->route('SubmenuList')->with('message', 'Menu Added successfully');
        }
        else{
            return redirect()->route('SubmenuList')->with('message', 'Failed to add menu');
        }
    }
    }

    public function SubmenuList(){
        $submenus = SubMenu::all();
        $menus = Menu::all();
        return view('Submenu.SubmenuList')->with('submenus',$submenus)->with('menus',$menus);
    }

    public function getSubMenuInformation(Request $request){
        $submenu = SubMenu::where('id',$request->id)->first();
        return $submenu;
    }

    public function submenuEdit(Request $request){
        $submenu = SubMenu::where('id',$request->id)->first();
        $menu = Menu::all();
        $menuName = Menu::where('id',$submenu->menuId)->first();
        return view('Submenu.editSubmenu')->with('submenu',$submenu)->with('menu',$menu)->with('menuName',$menuName);
    }
    public function submenuEditSubmit(Request $request){
        $menu = Menu::where('menuName',$request->menu)->first();
        // $codeCheck = SubMenu::where('code',$request->code)->first();
        // if($codeCheck){
        //     // return redirect()->route('SubmenuList')->with('message', 'Code Already exist');
        // }
        // else{
            $subMenu = SubMenu::where('id',$request->id)->first();
            $subMenu->menuId = $menu->id;
            $subMenu->subMenuName = $request->subMenuName;
            $subMenu->code = $request->code;
            $res = $subMenu->save();
            if($res){
            return redirect()->route('SubmenuList')->with('message', 'Menu Updated successfully');
            }
            else{
            return redirect()->route('SubmenuList')->with('message', 'Failed to update menu');
            }
        // }

    }

    public function deleteSubMenu($id){
        $submenu = SubMenu::findOrfail($id);

        SubMenu::where('id', $id)->delete();

        return redirect()->route('SubmenuList')->with('success', ' SubMenu Delete successfully');
    }
}
