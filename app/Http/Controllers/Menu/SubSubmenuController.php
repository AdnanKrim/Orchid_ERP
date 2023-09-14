<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserManagement\SubMenu;
use App\Models\UserManagement\Sub_Submenu;

class SubSubmenuController extends Controller
{
    public function SubSubmenuCreateForm()
    {
        $submenus = SubMenu::all();
        return view('SubSubmenu.addSubSubmenu')->with('submenus', $submenus);
    }

    public function SubSubmenuCreateSubmission(Request $request)
    {

        $submenus = SubMenu::where('subMenuName', $request->submenu)->first();
        $codeCheck = Sub_SubMenu::where('code', $request->code)->first();
        if ($codeCheck) {
            return redirect()->route('SubSubmenuList')->with('message', 'Code Already exist');
        } else {
            $subsubMenus = new Sub_SubMenu();
            $subsubMenus->submenuId = $submenus->id;
            $subsubMenus->sub_subMenuName = $request->name;
            $subsubMenus->code = $request->code;
            $res = $subsubMenus->save();
            if ($res) {
                return redirect()->back()->with('message', 'Sub sub-Menu Added successfully');
            } else {
                return redirect()->route('SubSubmenuList')->with('message', 'Failed to add menu');
            }
        }
    }

    public function SubSubmenuList()
    {
        $subsubmenus = Sub_SubMenu::all();
        $submenus = SubMenu::all();
        return view('SubSubmenu.SubSubmenuList')->with('subsubmenus', $subsubmenus)->with('submenus', $submenus);
    }

    public function getSubSubMenuInformation(Request $request)
    {
        $subsubmenu = Sub_SubMenu::where('id', $request->id)->first();
        return $subsubmenu;
    }

    public function SubsubmenuEdit(Request $request)
    {
        $subsubmenu = Sub_SubMenu::where('id', $request->id)->first();
        $submenus = SubMenu::all();
        $submenuName = SubMenu::where('id', $subsubmenu->submenuId)->first();
        return view('SubSubmenu.editSubSubmenu')->with('subsubmenu', $subsubmenu)->with('submenus', $submenus)->with('submenuName', $submenuName);
    }
    public function SubsubmenuEditSubmit(Request $request)
    {
        $submenus = SubMenu::where('submenuName', $request->submenu)->first();
        $subsubMenus = Sub_SubMenu::where('id', $request->id)->first();
        // $subsubMenus->submenuId = $submenus->id;
        $subsubMenus->sub_subMenuName = $request->sub_subMenuName;
        $subsubMenus->code = $request->code;
        $res = $subsubMenus->save();
        if ($res) {
            return redirect()->route('SubSubmenuList')->with('message', 'Sub Sub-Menu Updated successfully');
        } else {
            return redirect()->route('SubSubmenuList')->with('message', 'Failed to update Sub Sub-Menu');
        }
    }

    public function deleteSubSubMenu($id)
    {
        $subsubmenu = Sub_SubMenu::findOrfail($id);

        Sub_SubMenu::where('id', $id)->delete();

        return redirect()->route('SubSubmenuList')->with('success', ' Sub_SubMenu Delete successfully');
    }
}
