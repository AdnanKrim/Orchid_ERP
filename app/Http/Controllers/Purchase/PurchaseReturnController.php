<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\CRM\Leeds;
use App\Models\Project\ProjectDeal;
use App\Models\Purchase\PurchaseReturn;
use PDF;
use Mail;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class PurchaseReturnController extends Controller
{
    public function purchaseReturnForm(){
        return view('purchase.returnpurchaseform');
    }
    public function storePurchaseReturn(Request $req){
        $purchase = $req->id;
        $purchaseReturn = Helper::IdGenerator(new PurchaseReturn(),'purchaseReturnId',5,'PR');
        $data = new PurchaseReturn();
        $data->purchaseReturnId = $purchaseReturn;
        $data->purchaseInvoice = $req->purchaseInvoice;
        $data->clientId = $req->clientId;
        $data->supplierId = $req->supplierId;
        $data->projectId = $req->projectId;
        $data->products = json_encode($req->products);
        $data->shipment = $req->shipment;
        $data->grandTotal = $req->grandTotal;
        $data->paid = $req->paid;
        $data->due = $req->due;
        $data->date = $req->date;
        $data->paymentStatus= $req->paymentStatus;
        $data->save();


        return response('purchase-return-list')->with('message','Successful! New Purchase Return Created Successfully');
    }
    public function purchaseReturnList(){
//        $user = purchase::all();
        $data = PurchaseReturn::all();
        return view('purchase.purchasereturnlist',['purchases'=>$data]);
//        return response()->json($data);
    }
    public function getPurchaseReturnInformation(Request $request){
        $user = PurchaseReturn::where('id',$request->id)->first();
        return $user;
    }
    function purchaseReturnDelete(Request $request){
        PurchaseReturn::where('id',$request->id)->delete();
        return redirect()->back()->with('message','Successful! Purchase Return Deleted Successfully');
    }
    public Function purchaseReturnPDF(Request $req){
        $purchases = PurchaseReturn::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$purchases->clientId)->first();
        $project = ProjectDeal::where('id',$purchases->projectId)->first();
        $suppliers = Supplier::where('id',$purchases->supplierId)->first();
        $pdf = PDF::loadview('purchase.purchasereturnPDF',['project'=>$project,'purchases'=>$purchases,'leeds'=>$leeds,'suppliers'=>$suppliers]);
        return $pdf->setPaper('a4', 'letter')->setWarnings(false)->stream("view_purchase_return.pdf");
    }
    public Function purchaseReturnDwnPDF(Request $req){
        $purchases = PurchaseReturn::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$purchases->clientId)->first();
        $project = ProjectDeal::where('id',$purchases->projectId)->first();
        $suppliers = Supplier::where('id',$purchases->supplierId)->first();
        $pdf = PDF::loadview('purchase.purchasereturnPDF',['project'=>$project,'purchases'=>$purchases,'leeds'=>$leeds,'suppliers'=>$suppliers]);
        return $pdf->download("view_purchase_return.pdf");
    }
    public Function purchaseReturnMailPDF(Request $req){
        $purchases = PurchaseReturn::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$purchases->clientId)->first();
        $project = ProjectDeal::where('id',$purchases->projectId)->first();
        $suppliers = Supplier::where('id',$purchases->supplierId)->first();
        $pdf = PDF::loadview('purchase.purchasereturnPDF',['project'=>$project,'purchases'=>$purchases,'leeds'=>$leeds,'suppliers'=>$suppliers]);
        Mail::send('purchase.purchasereturnPDF',['project'=>$project,'purchases'=>$purchases,'leeds'=>$leeds,'suppliers'=>$suppliers],
            function ($message) use ($leeds, $purchases, $pdf){
                $message
                    ->to($leeds->email)
                    ->subject('Purchase Return Invoice')
                    ->attachData($pdf->output(),'view_purchase_return.pdf');
            });
        return redirect()->back()->with('message','Successful! Email Sent Successfully');
    }

}
