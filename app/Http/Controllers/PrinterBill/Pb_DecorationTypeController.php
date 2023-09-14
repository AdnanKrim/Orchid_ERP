<?php

namespace App\Http\Controllers\PrinterBill;

use App\Http\Controllers\Controller;
use App\Models\PrinterBill\Pb_DecorationType;
use Illuminate\Http\Request;

class Pb_DecorationTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addDecorationType()
    {
        return view('printerBill.decoration.addDecorationType');
    }
    public function editDecorationType(Request $request)
    {
        $decorationType = Pb_DecorationType::find($request->id);
        return view('printerBill.decoration.editDecorationType',['decorationType'=>$decorationType]);
    }
    public function createDecorationType(Request $request)
    {
        $decorationType = new Pb_DecorationType();
        $decorationType->name = $request->name;
        $decorationType->save();
        return redirect()->route('pb.dec.all')->with('message','New Decoration Type Created Successfully!');
    }
    public function updateDecorationType(Request $request)
    {
        $decorationType = Pb_DecorationType::find($request->id);
        $decorationType->name = $request->name;
        $decorationType->save();
        return redirect()->route('pb.dec.all')->with('message','New Decoration Type Updated Successfully!');
    }
    public function allDecorationType()
    {
        $decorationTypes = Pb_DecorationType::all();
        return view('printerBill.decoration.allDecorationType',['decorationTypes'=>$decorationTypes]);
    }
    public function deleteDecorationType(Request $request)
    {
        Pb_DecorationType::find($request->id)->delete();
        return redirect()->route('pb.dec.all')->with('message','Decoration Type Deleted Successfully!');
    }
}
