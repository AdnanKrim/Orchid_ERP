<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use App\Models\Product\Variations\Color;

use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function colorlist()
    {
        $user = Color::all();
        return view('product.color.colorlist', ['colors' => $user]);
    }
    public function addcolorform()
    {
        return view('product.color.addcolor');
    }
    function addcolor(Request $req)
    {
        $req->validate([
            'colorName' => 'required'
        ]);
        $user = new Color;
        $user->colorName = $req->colorName;
        $user->colorCode = $req->colorCode;
        $user->note = $req->note;
        $user->save();
        return redirect('color-list')->with('message','Successful! New Color Created Successfully');
    }
    public function getColorInformation(Request $request)
    {
        $user = Color::where('id', $request->id)->first();
        return $user;
    }
    function clrdelete(Request $request)
    {
        Color::where('id', $request->id)->delete();
        return redirect('color-list')->with('message','Successful! Color Deleted Successfully');
    }
    public function cedit($id){
        $data = Color::find($id);
        return view('product.color.updatecolor',['color'=>$data]);
    }
    function cupdate(Request $req){
        $data = Color::find($req->id);
        $data->colorName = $req->colorName;
        $data->colorCode = $req->colorCode;
        $data->note = $req->note;
        $data->save();
        return redirect('color-list')->with('message','Successful! Color Updated Successfully');
    }
    function colorSearch(Request $req)
    {
        $data = Color::where('colorName', 'like', '%' . $req->input('query') . '%')->get();
        return view('product.color.searchcolor', ['searchs' => $data]);
    }
}
