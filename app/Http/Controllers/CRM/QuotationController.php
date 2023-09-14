<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\HouseAreaCart;
use App\Models\CRM\Quotation;
use App\Models\CRM\subjectAndBody;
use http\Env\Response;
use PDF;
use Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\CRM\HouseAreaType;
use App\Models\CRM\DecorationType;
use App\Models\CRM\Leeds;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\length;

class QuotationController extends Controller
{
    public function allHouseTypes($id)
    {
        $leed = Leeds::find($id);
        $houseTypes = HouseAreaType::orderBy('id','desc')->get();
        return view('CRM.successLeeds.allHouseTypes', ['leed'=>$leed, 'houseTypes'=>$houseTypes]);
    }
    public function addHouseTypes($id)
    {
        $leed = Leeds::find($id);
        return view('CRM.successLeeds.addHouseTypes', ['leed'=>$leed]);
    }
    public function createHouseTypes(Request $request, $id)
    {
        $leed = Leeds::find($id);
        $houseTypes = new HouseAreaType();
        $houseTypes->name = $request->name;
        $houseTypes->save();
        return redirect::route('all-house-area-type', ['id'=>$leed->id])->with('message','New House Area type Created Successfully');
    }
    public function editHouseTypes($id, $houseType)
    {
        $leed = Leeds::find($id);
        $houseType = HouseAreaType::find($houseType);
        return view('CRM.successLeeds.editHouseTypes', ['leed'=>$leed, 'houseType'=>$houseType]);
    }
    public function updateHouseTypes(Request $request, $id, $houseType)
    {
        $leed = Leeds::find($id);
        $houseType = HouseAreaType::find($houseType);
        $houseType->name = $request->name;
        $houseType->save();
        return redirect::route('all-house-area-type', ['id'=>$leed->id])->with('message','House Area type Updated Successfully');
    }
    public function deleteHouseTypes($id, $houseType)
    {
        $leed = Leeds::find($id);
        $houseType = HouseAreaType::find($houseType);
        $houseType->delete();
        return redirect::route('all-house-area-type', ['id'=>$leed->id])->with('message','House Area type Deleted Successfully');
    }
    public function searchHouseTypes(Request $request, $id)
    {
        $leed = Leeds::find($id);
        $query = $request->searchType;
        $houseTypes = HouseAreaType::where('name', 'LIKE', '%'.$query.'%')->get();
        if ($houseTypes->name = $query)
        return view('CRM.successLeeds.searchResultTypes', ['houseTypes'=>$houseTypes,'query'=>$query, 'leed'=>$leed]);
    }
    public function allDecorationType($id)
    {
        $leed = Leeds::find($id);
        $decorationTypes = DecorationType::orderBy('houseAreaTypeId','asc')->get();
        return view('CRM.successLeeds.allDecorationType', ['decorationTypes'=>$decorationTypes,'leed'=>$leed]);
//        $houseTypes = [];
//        foreach($decorationTypes as $dType)
//        {
//            $typeId = $dType->houseAreaTypeId;
//            $houseTypes =  HouseAreaType::where('id', $typeId)->get();
//            foreach ($houseTypes as $htId)
//            {
//                $hti = $htId->name;
//            }
//        }
    }
    public function addDecorationType($id)
    {
        $leed = Leeds::find($id);
        $houseTypes = HouseAreaType::all();
        return view('CRM.successLeeds.addDecorationType', ['leed'=>$leed, 'houseTypes'=>$houseTypes]);
    }
    public function createDecorationType(Request $request,$id)
    {
        $leed = Leeds::find($id);
        $decorationTypes = new DecorationType();
        $decorationTypes->houseAreaTypeId = $request->houseAreaTypeId;
        $decorationTypes->name = $request->name;
        $decorationTypes->description = $request->description;
        $decorationTypes->unit = $request->unit;
        $decorationTypes->rate = $request->rate;
        $decorationTypes->save();
        return redirect::route('all-decoration-type', ['id'=>$leed])->with('message', 'New Decoration Type created Successfully');
    }
    public function editDecorationType($id, $decor)
    {
        $leed = Leeds::find($id);
        $houseTypes = HouseAreaType::all();
        $decorationType = DecorationType::find($decor);
        return view('CRM.successLeeds.editDecorationType', ['leed'=>$leed, 'decorationType'=>$decorationType, 'houseTypes'=>$houseTypes]);
    }
    public function updateDecorationType(Request $request, $id, $decor)
    {
        $leed = Leeds::find($id);
        $decorationType = DecorationType::find($decor);
        $decorationType->houseAreaTypeId = $request->houseAreaTypeId;
        $decorationType->name = $request->name;
        $decorationType->description = $request->description;
        $decorationType->unit = $request->unit;
        $decorationType->rate = $request->rate;
        $decorationType->save();
        return redirect::route('all-decoration-type', ['id'=>$leed])->with('message', 'New Decoration Type Updated Successfully');
    }
    public function deleteDecorationType($id, $decor)
    {
        $leed = Leeds::find($id);
        $decorationType = DecorationType::find($decor);
        $decorationType->delete();
        return redirect::route('all-decoration-type', ['id'=>$leed])->with('message', 'Decoration Type Deleted Successfully');
    }
//    public function allSubBody($id)
//    {
//        $leed = Leeds::find($id);
//        $subBody = subjectAndBody::where('type', 'QUOTATION')->get();
//        return view('CRM.successLeeds.allSubBody',['leed'=>$leed, 'subBody'=>$subBody]);
//    }
//    public function addSubBody($id)
//    {
//        $leed = Leeds::find($id);
//        return view('CRM.successLeeds.addSubBody',['leed'=>$leed]);
//    }
//    public function createSubBody(Request $request, $id)
//    {
//        $leed = Leeds::find($id);
//        $subBody = new subjectAndBody();
//        $subBody->type = $request->type;
//        $subBody->subject = $request->subject;
//        $subBody->body = $request->body;
//        $subBody->save();
//        return redirect::route('all-sub-body',['id'=>$leed])->with('message', 'New Subject & Body Created Successfully');
//    }
    public function editSubBody($id)
    {
        $leed = Leeds::find($id);
        $subBody = subjectAndBody::where('type', 'QUOTATION')->first();
        return view('CRM.successLeeds.editSubBody',['leed'=>$leed,'subBody'=>$subBody]);
    }
    public function updateSubBody(Request $request, $id, $sbId)
    {
        $leed = Leeds::find($id);
        $subBody = subjectAndBody::find($sbId);
        $subBody->subject = $request->subject;
        $subBody->body = $request->body;
        $subBody->save();
        return redirect::route('edit-sub-body',['id'=>$leed->id])->with('message', 'Subject & Body Updated Successfully');
    }
//    public function deleteSubBody($id, $sbId)
//    {
//        $leed = Leeds::find($id);
//        $subBody = subjectAndBody::find($sbId);
//        $subBody->delete();
//        return redirect::route('all-sub-body',['id'=>$leed])->with('message', 'Subject & Body Deleted Successfully');
//    }
    public function allQuotation($id)
    {
        $leed = Leeds::find($id);
        $quotes = Quotation::orderBy('id','desc')->first();
        $qId = $quotes->id;
        $carts = HouseAreaCart::where('quotationId',$qId)->get();
        return view('CRM.successLeeds.viewCart',['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts]);
    }
    public function addQuotation($id)
    {
        $leed = Leeds::find($id);
        $subBodies = subjectAndBody::all();
        return view('CRM.successLeeds.addQuotation',['leed'=>$leed, 'subBodies'=>$subBodies]);
    }
    public function createQuotation(Request $request, $id)
    {
        $leed = Leeds::find($id);
        $quotation = new Quotation();
        $quotation->leedsId = $leed->id;
        $quotation->subject = $request->subject;
        $quotation->body = $request->body;
        $quotation->totalAmount = $request->totalAmount;
        $quotation->totalVat = $request->totalVat;
        $quotation->grandTotal = $request->grandTotal;
        $quotation->note = $request->note;
        $quotation->save();
        return redirect::route('all-quotation',['id'=>$leed])->with('message', 'New Quotation Created Successfully');
    }
    public function deleteQuotation($id, $qId)
    {
        $leed = Leeds::find($id);
        $quotation = Quotation::find($qId);
        $quotation->delete();
        return redirect::route('all-quotation',['id'=>$leed])->with('message', 'Quotation Deleted Successfully');
    }
    public function allCart($id)
    {
        $leed = Leeds::find($id);
        return view('CRM.successLeeds.allCart',['leed'=>$leed]);
    }
    public function addCart($id)
    {
        $leed = Leeds::find($id);
        $quotations = Quotation::all();
        $houseTypes = HouseAreaType::all();
        $decorTypes = DecorationType::all();
        return view('CRM.successLeeds.addCart',['leed'=>$leed, 'quotations'=>$quotations, 'houseTypes'=>$houseTypes, 'decorTypes'=>$decorTypes]);
    }
    public function createCart(Request $request){
        $leedId = $request->id;
        $quote = new Quotation();
        $quote->leedsId = $leedId;
        $quote->subject = $request->subject;
        $quote->body = $request->body;
        $quote->totalAmount = $request->allTotal;
        $quote->discount = $request->discC;
        $quote->totalVat = $request->vatC;
        $quote->grandTotal = $request->finalTotal;
        $quote->save();
        if ($tabs = $request->get('ht')) {
            foreach ($tabs as $tab) {
                HouseAreaCart::create([
                    'quotationId'       => $quote->id,
                    'houseAreaTypeId'   => $tab['selectedHouseType'],
                    'houseAreaCartInfo' => json_encode($tab['rows']),
                ]);
            }
        }
        return [
            'id'=>$leedId,
            'qId'=>$quote->id,
        ];
    }
    public function viewCart($id, $qId)
    {
        $leed = Leeds::find($id);
        $quotes = Quotation::where('id',$qId)->first();
        $carts = HouseAreaCart::where('quotationId',$qId)->get();
        return view('CRM.successLeeds.viewCart',['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts]);
    }
    public function viewPdf($id, $qId)
    {
        $leed = Leeds::find($id);
        $quotes = Quotation::where('id',$qId)->first();
        $carts = HouseAreaCart::where('quotationId',$qId)->get();
        $pdf = PDF::loadView('CRM.successLeeds.pdf.view_cart', ['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts]);
//        return $pdf->stream("view_cart.pdf", array("Attachment" => false));
        return $pdf->setPaper('a4', 'letter')->setWarnings(false)->stream("view_cart.pdf");

//        return view('CRM.successLeeds.pdf.view_cart',['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts]);
    }
    public function downloadPdf($id, $qId)
    {
        $leed = Leeds::find($id);
        $quotes = Quotation::where('id',$qId)->first();
        $carts = HouseAreaCart::where('quotationId',$qId)->get();
        $pdf = PDF::loadView('CRM.successLeeds.pdf.view_cart', ['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts]);
        return $pdf->download('view_cart.pdf');
//        return view('CRM.successLeeds.pdf.view_cart',['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts]);
    }
    public function mailPdf($id, $qId)
    {
        $leed = Leeds::find($id);
        $quotes = Quotation::where('id',$qId)->first();
        $carts = HouseAreaCart::where('quotationId',$qId)->get();
        $pdf = PDF::loadView('CRM.successLeeds.pdf.view_cart', ['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts]);
        Mail::send('CRM.successLeeds.pdf.view_cart', ['leed'=>$leed, 'quotes'=>$quotes, 'carts'=>$carts],
        function ($message) use ($leed, $quotes, $pdf){
            $message
                ->to($leed->email)
                ->subject($quotes->subject)
                ->attachData($pdf->output(), 'view_cart.pdf')
            ;
        });
        return redirect()->back();
    }
}
