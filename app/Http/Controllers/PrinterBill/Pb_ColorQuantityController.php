<?php

namespace App\Http\Controllers\PrinterBill;

use App\Http\Controllers\Controller;
use App\Models\PrinterBill\Pb_Color;
use App\Models\PrinterBill\Pb_DecorationType;
use App\Models\PrinterBill\Pb_HouseAreaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Pb_ColorQuantityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['getDecorationTypes','getHouseAreaTypes','getColor','getArray']]);
    }
    public function addColorQty()
    {
        return view('printerBill.color_Qty.addColorQty');
    }
    public function getHouseAreaTypes()
    {
        $houseAreaTypes = Pb_HouseAreaType::all();
        return response()->json($houseAreaTypes);
    }
    public function getDecorationTypes()
    {
        $decorationTypes = Pb_DecorationType::all();
        return response()->json($decorationTypes);
    }
    public function getColor()
    {
        $colors = Pb_Color::all();
        return response()->json($colors);
    }
    public function getArray()
    {
        $info = request('info');
        Log::info($info);
    }
}
