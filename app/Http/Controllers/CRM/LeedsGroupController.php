<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CRM\Group;
use App\Models\CRM\Leeds;

class LeedsGroupController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    public function groupList()
    {
        $groups = Group::orderBy('id', 'desc')->get();
        return view('CRM.leeds.groupList', ['groups'=>$groups]);
    }
    public function addGroup()
    {
        return view('CRM.leeds.addGroup');
    }
    public function createGroup(Request $request)
    {
        $groups = new Group();
        $groups->leedsGroupName = $request->leedsGroupName;
        $groups->save();
        return redirect('/allLeedsGroup')->with('message', 'New leeds Group Created Successfully');
    }
    public function editGroup($id)
    {
        $group = Group::find($id);
        return view('CRM.leeds.editGroup',['group'=>$group]);
    }
    public function updateGroup(Request $request, $id)
    {
        $group = Group::find($id);
        $group->leedsGroupName = $request->leedsGroupName;
        $group->save();
        return redirect('/allLeedsGroup')->with('message', 'leeds Group Updated Successfully');
    }
    public function deleteGroup($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect('/allLeedsGroup')->with('message', 'leeds Group Deleted Successfully');
    }
    public function searchGroup(Request $request)
    {
        $query=$request->searchText;
        $group = Group::where('leedsGroupName', 'LIKE', '%' .$query.'%')->get();
        if ($group->leedsGroupName=$query)
        return view('CRM.leeds.searchGroupResult', ['group' => $group, 'query'=>$query]);
    }
    public function leedsInGroup($id)
    {
        $leeds = Leeds::where('leedsGroupId', $id)->get();
        return view('CRM.leeds.leedsInGroup', ['leeds' => $leeds]);
    }
    public function getGroups(Request $req)
    {
        $groups = [];

        if($req->has('q')){
            $search = $req->q;
            $groups = Group::select("id", "leedsGroupName")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($groups);
    }
}
