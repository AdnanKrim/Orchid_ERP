<?php

namespace App\Http\Controllers\PrinterBill;

use App\Http\Controllers\Controller;
use App\Models\PrinterBill\Pb_Color;
use Illuminate\Http\Request;

class Pb_ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addColor()
    {
        return view('printerBill.color.addColor');
    }
    public function editColor(Request $request)
    {
        $color = Pb_Color::find($request->id);
        return view('printerBill.color.editColor',['color'=>$color]);
    }
    public function createColor(Request $request)
    {
        $color = new Pb_Color();
        $color->color = $request->color;
        $color->unit = $request->unit;
        $color->save();
        return redirect()->route('pb.color.all')->with('message','New Color Created Successfully!');
    }
    public function updateColor(Request $request)
    {
        $color = Pb_Color::find($request->id);
        $color->color = $request->color;
        $color->unit = $request->unit;
        $color->save();
        return redirect()->route('pb.color.all')->with('message','Color Updated Successfully!');
    }
    public function allColor()
    {
        $colors = Pb_Color::all();
        return view('printerBill.color.allColor',['colors'=>$colors]);
    }
    public function deleteColor(Request $request)
    {
        Pb_Color::find($request->id)->delete();
        return redirect()->route('pb.color.all')->with('message','Color Deleted Successfully!');
    }
}
