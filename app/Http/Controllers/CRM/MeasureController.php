<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Support\Facades\DB;
use PDF;
use Mail;
use App\Http\Controllers\Controller;
use App\Models\CRM\Leeds;
use App\Models\CRM\Measurement\Measurement;
use App\Models\CRM\Measurement\MeasurementCart;
use App\Models\CRM\Measurement\MeasurementStructureType;
use Illuminate\Support\Facades\Redirect;
use App\Models\CRM\Measurement\MeasurementType;
use App\Models\CRM\Measurement\MeasurementCartChildless;
use Illuminate\Http\Request;

class MeasureController extends Controller
{
    public function addMeasureType($id)
    {
        $leed = Leeds::find($id);
        return view('CRM.successLeeds.measurements.addMeasureType', ['leed'=>$leed]);
    }
    public function createMeasureType(Request $request, $id)
    {
        $leed = Leeds::find($id);
        $measureType = new MeasurementType();
        $measureType->measurementTypeName = $request->measurementTypeName;
        $measureType->unit = $request->unit;
        $measureType->rate = $request->rate;
        $measureType->note = $request->note;
        $measureType->save();
        return redirect::route('all-measure-types', ['id'=>$leed->id])->with('message','New Measure Type Created Successfully');
    }
    public function allMeasureTypes($id)
    {
        $leed = Leeds::find($id);
        $measureTypes = MeasurementType::all();
        return view('CRM.successLeeds.measurements.allMeasureTypes', ['leed'=>$leed, 'measureTypes'=>$measureTypes]);
    }
    public function editMeasureType($id, $mtId)
    {
        $leed = Leeds::find($id);
        $measureType = MeasurementType::find($mtId);
        return view('CRM.successLeeds.measurements.editMeasureType', ['leed'=>$leed, 'measureType'=>$measureType]);
    }
    public function updateMeasureType(Request $request, $id, $mtId)
    {
        $leed = Leeds::find($id);
        $measureType = MeasurementType::find($mtId);
        $measureType->measurementTypeName = $request->measurementTypeName;
        $measureType->unit = $request->unit;
        $measureType->rate = $request->rate;
        $measureType->note = $request->note;
        $measureType->save();
        return redirect::route('all-measure-types', ['id'=>$leed->id])->with('message','New Measure Type Updated Successfully');
    }
    public function deleteMeasureType($id, $mtId)
    {
        $leed = Leeds::find($id);
        $measureType = MeasurementType::find($mtId);
        $measureType->delete();
        return redirect::route('all-measure-types', ['id'=>$leed->id])->with('message','New Measure Type Deleted Successfully');
    }
    public function allMeasureStruct($id)
    {
        $leed = Leeds::find($id);
        $measureStruct = MeasurementStructureType::all();
        return view('CRM.successLeeds.measurements.allMeasureStruct', ['leed'=>$leed, 'measureStruct'=>$measureStruct]);
    }
    public function addMeasureStruct($id)
    {
        $leed = Leeds::find($id);
        $measureTypes = MeasurementType::all();
        return view('CRM.successLeeds.measurements.addMeasureStruct', ['leed'=>$leed, 'measureTypes'=>$measureTypes]);
    }
    public function createMeasureStruct(Request $request, $id)
    {
        $leed = Leeds::find($id);
        $measureStruct = new MeasurementStructureType();
        $measureStruct->measurementTypeId = $request->measurementTypeId;
        $measureStruct->measurementStructureName = $request->measurementStructureName;
        $measureStruct->unit = $request->unit;
        $measureStruct->note = $request->note;
        $measureStruct->save();
        return redirect::route('all-measure-struct', ['id'=>$leed->id])->with('message','New Measure Structure Created Successfully');
    }
    public function editMeasureStruct($id, $mStr)
    {
        $leed = Leeds::find($id);
        $measureStruct = MeasurementStructureType::find($mStr);
        $mtn = MeasurementType::find($measureStruct->measurementTypeId);
        $measureTypes = MeasurementType::all();
        return view('CRM.successLeeds.measurements.editMeasureStruct', ['leed'=>$leed, 'measureStruct'=>$measureStruct, 'measureTypes'=>$measureTypes, 'mt'=>$mtn]);
    }
    public function updateMeasureStruct(Request $request,$id, $mStr)
    {
        $leed = Leeds::find($id);
        $measureStruct = MeasurementStructureType::find($mStr);
        $measureStruct->measurementTypeId = $request->measurementTypeId;
        $measureStruct->measurementStructureName = $request->measurementStructureName;
        $measureStruct->unit = $request->unit;
        $measureStruct->note = $request->note;
        $measureStruct->save();
        return redirect::route('all-measure-struct', ['id'=>$leed->id])->with('message','Measure Structure Updated Successfully');
    }
    public function deleteMeasureStruct($id, $mStr)
    {
        $leed = Leeds::find($id);
        $measureStruct = MeasurementStructureType::find($mStr);
        $measureStruct->delete();
        return redirect::route('all-measure-struct', ['id'=>$leed->id])->with('message','Measure Structure Deleted Successfully');
    }
    public function measureCart($id)
    {
        $leed = Leeds::find($id);
        return view('CRM.successLeeds.measurements.measureCart', ['leed'=>$leed]);
    }
    public function getMeasureTypes()
    {
        $measureTypes = MeasurementType::all();
        return response()->json($measureTypes);
    }
    public function getMeasureStruct()
    {
        $measureTypeId = request('measureTypeId');
        $measureStructs = MeasurementStructureType::where('measurementTypeId',$measureTypeId)->get();
        return response()->json($measureStructs);
    }
    public function getRate()
    {
        $measureTypeId = request('id');
        $measureType = MeasurementType::find($measureTypeId);
        return response()->json($measureType);
    }
    public function createMeasureCart(Request $request)
    {
        $leedId = $request->id;
        $measure = new Measurement();
        $measure->leedsId = $leedId;
        $measure->totalAmount = $request->allTotal;
        $measure->discount = $request->discC;
        $measure->vat = $request->vatC;
        $measure->grandTotal = $request->finalTotal;
        $measure->advanced = $request->adv;
        $measure->totalPayableAmount = $request->payable;
        $measure->save();
        if ($tabs = $request->get('mt')) {
            foreach ($tabs as $tab) {
                MeasurementCart::create([
                    'measurementId'       => $measure->id,
                    'measurementTypeId'   => $tab['selectedMeasureType'],
                    'totalQty'            => $tab['tabQty'],
                    'totalAmount'         => $tab['tabtotal'],
                    'measurementCartInfo' => json_encode($tab['rows']),
                ]);
            }
        }
        if ($tabs1 = $request->get('mt1')) {
            foreach ($tabs1 as $tab1) {
                MeasurementCartChildless::create([
                    'measurementId'       => $measure->id,
                    'measurementTypeId'   => $tab1['selectedMeasureType'],
                    'totalQty'            => $tab1['tabQty'],
                    'totalAmount'         => $tab1['line_total'],
                    'measurementCartInfo' => json_encode([
                        'selectedRate' => $tab1['selectedRate'],
                        'selectedQty' => $tab1['selectedQty'],
                        'line_total' => $tab1['line_total'],
                    ]),
                ]);
            }
        }
        return [
            'id'=>$leedId,
            'mId'=>$measure->id,
        ];
    }
    public function viewMeasurement($id)
    {
        $leed = Leeds::find($id);
        $measure = Measurement::orderBy('id','desc')->first();
        $measureCarts = MeasurementCart::where('measurementId',$measure->id)->get();
        $childlessCarts = MeasurementCartChildless::where('measurementId',$measure->id)->get();
        return view('CRM.successLeeds.measurements.viewMeasureCart',['leed'=>$leed, 'measure'=>$measure, 'measureCarts'=>$measureCarts, 'childless'=>$childlessCarts]);
    }
    public function viewMeasureCart($id, $mId)
    {
        $leed = Leeds::find($id);
        $measure = Measurement::where('id',$mId)->first();
        $measureCarts = MeasurementCart::where('measurementId',$mId)->get();
        $childlessCarts = MeasurementCartChildless::where('measurementId',$mId)->get();
        return view('CRM.successLeeds.measurements.viewMeasureCart',['leed'=>$leed, 'measure'=>$measure, 'measureCarts'=>$measureCarts, 'childless'=>$childlessCarts]);
    }
    public function viewMeasurePdf($id, $mId)
    {
        $leed = Leeds::find($id);
        $measure = Measurement::where('id',$mId)->first();
        $measureCarts = MeasurementCart::where('measurementId',$mId)->get();
        $childlessCarts = MeasurementCartChildless::where('measurementId',$mId)->get();
        $pdf = PDF::loadView('CRM.successLeeds.pdf.measurePdf',['leed'=>$leed, 'measure'=>$measure, 'measureCarts'=>$measureCarts, 'childless'=>$childlessCarts]);
        return $pdf->setPaper('a4', 'letter')->setWarnings(false)->stream('measurement-cart.pdf');
    }
    public function downloadMeasurePdf($id, $mId)
    {
        $leed = Leeds::find($id);
        $measure = Measurement::where('id',$mId)->first();
        $measureCarts = MeasurementCart::where('measurementId',$mId)->get();
        $childlessCarts = MeasurementCartChildless::where('measurementId',$mId)->get();
        $pdf = PDF::loadView('CRM.successLeeds.pdf.measurePdf',['leed'=>$leed, 'measure'=>$measure, 'measureCarts'=>$measureCarts, 'childless'=>$childlessCarts]);
        return $pdf->setPaper('a4', 'letter')->setWarnings(false)->download('measurement-cart.pdf');
    }
    public function mailMeasurePdf($id, $mId)
    {
        $leed = Leeds::find($id);
        $measure = Measurement::where('id',$mId)->first();
        $measureCarts = MeasurementCart::where('measurementId',$mId)->get();
        $childlessCarts = MeasurementCartChildless::where('measurementId',$mId)->get();
        $pdf = PDF::setPaper('a4', 'letter')->setWarnings(false)->loadView('CRM.successLeeds.pdf.measurePdf',['leed'=>$leed, 'measure'=>$measure, 'measureCarts'=>$measureCarts, 'childless'=>$childlessCarts]);
        Mail::send('CRM.successLeeds.pdf.measureMail', ['leed'=>$leed, 'measure'=>$measure, 'measureCarts'=>$measureCarts, 'childless'=>$childlessCarts],
            function ($message) use ($leed, $pdf){
                $message
                    ->to($leed->email)
                    ->subject('Measurements Details & contract Paper')
                    ->attachData($pdf->output(), 'measurement-cart.pdf')
                ;
            });
        return redirect()->back();
    }

}
