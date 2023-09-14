<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\subjectAndBody;
use Illuminate\Http\Request;
use App\Models\CRM\Quotation;
use App\Models\CRM\HouseAreaType;
use App\Models\CRM\DecorationType;

class CartController extends Controller
{
    public function getQuotations()
    {
        $quotations = Quotation::all();
        return response()->json($quotations);
    }
    public function getHouseTypes()
    {
        $houseTypes = HouseAreaType::all();
        return response()->json($houseTypes);
    }
    public function getDecorTypes()
    {
        $houseAreaTypeId = request('houseAreaTypeId');

        $decorTypes = DecorationType::where('houseAreaTypeId',$houseAreaTypeId)->get();
        return response()->json($decorTypes);
    }


    public function getDescription()
    {
        $id = request('id');
        $decorDes = DecorationType::where('id',$id)->get();
        return response()->json($decorDes);
    }
    public function getSubject()
    {
        $subjects = subjectAndBody::where('type', 'QUOTATION')->first();
        return response()->json($subjects);
    }
}
