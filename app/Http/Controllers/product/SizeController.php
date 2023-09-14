<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use App\Models\Product\Variations\Size;

use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function sizelist()
    {
        $user = Size::all();
        return view('product.size.sizelist', ['sizes' => $user]);
    }
    public function addsizeform()
    {
        return view('product.size.addsize');
    }
    function addsize(Request $req)
    {
        $req->validate([
            'sizeName' => 'required'
        ]);
        $user = new Size;
        $user->sizeName = $req->sizeName;
        $user->sizeValue = $req->sizeValue;
        $user->note = $req->note;
        $user->save();
        return redirect('size-list')->with('message','Successful! New Size Created Successfully');
    }
    public function getSizeInformation(Request $request)
    {
        $user = Size::where('id', $request->id)->first();
        return $user;
    }
    function szdelete(Request $request)
    {
        Size::where('id', $request->id)->delete();
        return redirect('size-list')->with('message','Successful! Size Deleted Successfully');
    }
    public function szedit($id){
        $data = Size::find($id);
        return view('product.size.updatesize',['size'=>$data]);
    }
    function szupdate(Request $req){
        $data = Size::find($req->id);
        $data->sizeName = $req->sizeName;
        $data->sizeValue = $req->sizeValue;
        $data->note = $req->note;
        $data->save();
        return redirect('size-list')->with('message','Successful! Size Updated Successfully');
    }
    function sizeSearch(Request $req)
    {
        $data = Size::where('sizeName', 'like', '%' . $req->input('query') . '%')->get();
        return view('product.size.searchsize', ['searchs' => $data]);
    }
}
