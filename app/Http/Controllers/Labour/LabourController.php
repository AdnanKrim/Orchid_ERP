<?php

namespace App\Http\Controllers\Labour;

use App\Http\Controllers\Controller;
use App\Models\Labour\Labourname;
use App\Models\CRM\Leeds;
use PDF;
use Mail;
use App\Models\Labour\Labourtype;
use App\Models\Labour\Labourbill;
use App\Models\Purchase\purchase;
use App\Models\Purchase\PurchaseType;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class LabourController extends Controller
{
    //LabourName
    public function labourlist()
    {
        $user = Labourname::all();
        return view('labour.labourname', ['labors' => $user]);
    }
    public function addLabourForm()
    {
        return view('labour.addlabour');
    }
    function addLabour(Request $req)
    {
        $req->validate([
            'labourName' => 'required'
        ]);
        $user = new Labourname;
        $user->labourName = $req->labourName;
        $user->labourId = $req->labourId;
        $user->mob1No = $req->mob1No;
        $user->mob2No = $req->mob2No;
        $user->email= $req->email;
        $user->subDistrict = $req->subDistrict;
        $user->district = $req->district;
        $user->address = $req->address;
        $user->note = $req->note;
        $user->save();
        return redirect('labour-list')->with('message','Successful! New Labour Created Successfully');
    }
    public function getLabourInformation(Request $request)
    {
        $user = Labourname::where('id', $request->id)->first();
        return $user;
    }
    function lbrdelete(Request $request)
    {
        Labourname::where('id', $request->id)->delete();
        return redirect('labour-list')->with('message','Successful! Labour Deleted Successfully');
    }
    public function lbrEdit($id){
        $data = Labourname::find($id);
        return view('labour.updatelabour',['labor'=>$data]);
    }
    function labourUpdate(Request $req){
        $data = Labourname::find($req->id);
        $data->labourName = $req->labourName;
        $data->labourId = $req->labourId;
        $data->mob1No = $req->mob1No;
        $data->mob2No = $req->mob2No;
        $data->email= $req->email;
        $data->subDistrict = $req->subDistrict;
        $data->district = $req->district;
        $data->address = $req->address;
        $data->note = $req->note;
        $data->save();
        return redirect('labour-list')->with('message','Successful! Labour Updated Successfully');
    }
    function labourSearch(Request $req)
    {
        $data = Labourname::where('labourName', 'like', '%' . $req->input('query') . '%')->get();
        return view('labour.searchlabour', ['labors' => $data]);
    }
    //LabourName

    //LabourType
    public function labourTypeList()
    {
        $user = Labourtype::all();
        return view('labour.labourtypename', ['labors' => $user]);
    }
    public function addLabourTypeForm()
    {
        return view('labour.addlabourtype');
    }
    function addLabourType(Request $req)
    {
        $req->validate([
            'labourTypeName' => 'required'
        ]);
        $user = new Labourtype;
        $user->labourTypeName = $req->labourTypeName;
        $user->code= $req->code;
        $user->save();
        return redirect('labour-type-list')->with('message','Successful! New Labour Type Created Successfully');
    }
    public function getLabourTypeInformation(Request $request)
    {
        $user = Labourtype::where('id', $request->id)->first();
        return $user;
    }
    function lbrtypedelete(Request $request)
    {
        Labourtype::where('id', $request->id)->delete();
        return redirect('labour-type-list')->with('message','Successful! Labour Type Deleted Successfully');
    }
    public function lbrTypeEdit($id){
        $data = Labourtype::find($id);
        return view('labour.updatelabourtype',['labor'=>$data]);
    }
    function labourTypeUpdate(Request $req){
        $data = Labourtype::find($req->id);
        $data->labourTypeName = $req->labourTypeName;
        $data->code = $req->code;
        $data->save();
        return redirect('labour-type-list')->with('message','Successful! Labour Type Updated Successfully');
    }
    function labourTypeSearch(Request $req)
    {
        $data = Labourtype::where('labourTypeName', 'like', '%' . $req->input('query') . '%')->get();
        return view('labour.searchlabourtype', ['labors' => $data]);
    }
    //LabourBill
    public function addLabourBill(){
        return View('labour.addlabourbill');
    }
    public function getLabourNames(){
        $labourname = Labourname::all();
            return response()->json($labourname);
    }
    public function getLabourTypes(){
        $labourtype = Labourtype::all();
        return response()->json($labourtype);
    }
    public function getPurchaseType(){
        $data = PurchaseType::all();
        return response()->json($data);
    }
//    public function getProductData(){
//        $user = request('id');
//        $data = purchase::where('id',$user)->first();
//        $products = json_decode($data->products);
//        foreach ($products as $product){
//            $pdt = $product->productId;
//            $good = Product::where('id',$pdt)->get();
//        }
//        return response()->json($good);
//    }
    public function getProductData(){
        $good = Product::all();
        return response()->json($good);
    }
    public function getPurchaseData(){
        $user = request('id');
        $purchases = purchase::where('clientId',$user)->get();


        $productsId = [];
       foreach ($purchases as $key => $purchase){
//           $products = array_merge($products, json_decode($purchase->products));
           foreach (json_decode($purchase->products) as $pro ){
               $productsId[] = $pro->productId;
           }
       }

       $products = Product::whereIn('id', $productsId)->with('unit')->get();

        return response()->json($products);
    }
    public function storeLabourBill(Request $req){
        $purchase = $req->id;
        $labour_Id = Helper::IdGenerator(new Labourbill,'labourId',5,'LB');
        $data = new Labourbill();
        $data->labourNameId = $req->labourNameId;
        $data->labourTypeId = $req->labourTypeId;
        $data->clientId = $req->clientId;
        $data->labourId = $labour_Id;
        $data->purchaseCategoryId = $req->purchaseCategoryId;
        $data->products = json_encode($req->products);
        $data->grandTotal = $req->grandTotal;
        $data->CSFCAmount = $req->CSFCAmount;
        $data->finalTotal = $req->finalTotal;
        $data->paid = $req->paid;
        $data->due = $req->due;
        $data->date = $req->date;
        $data->paymentStatus= $req->paymentStatus;
        $data->save();

        return response('labour-bill-list')->with('message','Successful! New LabourBill Created Successfully');
    }
    public function getOldLabourId(){
        $labour_Id = Helper::IdGenerator(new Labourbill,'labourId',5,'LB');
        return response($labour_Id);
    }
    public function labourBillList(){
        $labours = Labourbill::all();
        return view('labour.labourlist',['labours'=>$labours]);
    }
    public function getLabourBillInformation(Request $request)
    {
        $user = Labourbill::where('id', $request->id)->first();
        return $user;
    }
    function lbrbilldelete(Request $request)
    {
        Labourbill::where('id', $request->id)->delete();
        return redirect('labour-bill-list')->with('message','Successful! Labour Bill Deleted Successfully');
    }
    public Function labourBillPDF(Request $req){
        $labour = Labourbill::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$labour->clientId)->first();
        $labourName = Labourname::where('id',$labour->labourNameId)->first();
        $labourType = Labourtype::where('id',$labour->labourTypeId)->first();
        $pdf = PDF::loadview('labour.labourbillPDF',['labour'=>$labour,'leeds'=>$leeds,'labourName'=>$labourName,'labourType'=>$labourType]);
        return $pdf->setPaper('a4', 'letter')->setWarnings(false)->stream("view_labourBill.pdf");
    }
    public Function labourBillDwnPDF(Request $req){
        $labour = Labourbill::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$labour->clientId)->first();
        $labourName = Labourname::where('id',$labour->labourNameId)->first();
        $labourType = Labourtype::where('id',$labour->labourTypeId)->first();
        $pdf = PDF::loadview('labour.labourbillPDF',['labour'=>$labour,'leeds'=>$leeds,'labourName'=>$labourName,'labourType'=>$labourType]);
        return $pdf->download("view_labourBill.pdf");
    }
    public Function labourBillMailPDF(Request $req){
        $labour = Labourbill::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$labour->clientId)->first();
        $labourName = Labourname::where('id',$labour->labourNameId)->first();
        $labourType = Labourtype::where('id',$labour->labourTypeId)->first();
        $pdf = PDF::loadview('labour.labourbillPDF',['labour'=>$labour,'leeds'=>$leeds,'labourName'=>$labourName,'labourType'=>$labourType]);
        Mail::send('labour.labourbillPDF',['labour'=>$labour,'leeds'=>$leeds,'labourName'=>$labourName,'labourType'=>$labourType],
            function ($message) use ($leeds, $labourName, $pdf){
                $message
                    ->to($leeds->email)
                    ->subject($labourName->labourName)
                    ->attachData($pdf->output(),'view_labour_bill.pdf');
            });
        return redirect()->back()->with('message','Successful! Email Sent Successfully');
    }

}
