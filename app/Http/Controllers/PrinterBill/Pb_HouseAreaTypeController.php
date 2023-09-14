<?php

namespace App\Http\Controllers\PrinterBill;

use App\Http\Controllers\Controller;
use App\Models\PrinterBill\Pb_HouseAreaType;
use Illuminate\Http\Request;

class Pb_HouseAreaTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addHouseAreaType()
    {
        return view('printerBill.houseAreaType.addHouseType');
    }
    public function editHouseAreaType(Request $request)
    {
        $houseAreaType = Pb_HouseAreaType::find($request->id);
        return view('printerBill.houseAreaType.editHouseType',['houseAreaType'=>$houseAreaType]);
    }
    public function createHouseAreaType(Request $request)
    {
        $houseAreaType = new Pb_HouseAreaType();
        $houseAreaType->name = $request->name;
        $houseAreaType->save();
        return redirect()->route('pb.hat.all')->with('message','New House Area Type Created Successfully!');
    }
    public function updateHouseAreaType(Request $request)
    {
        $houseAreaType = Pb_HouseAreaType::find($request->id);
        $houseAreaType->name = $request->name;
        $houseAreaType->save();
        return redirect()->route('pb.hat.all')->with('message','New House Area Type Updated Successfully!');
    }
    public function allHouseAreaType()
    {
        $houseAreaTypes = Pb_HouseAreaType::all();
        return view('printerBill.houseAreaType.allHouseType',['houseAreaTypes'=>$houseAreaTypes]);
    }
    public function deleteHouseAreaType(Request $request)
    {
        Pb_HouseAreaType::find($request->id)->delete();
        return redirect()->route('pb.hat.all')->with('message','House Area Type Deleted Successfully!');
    }
}
