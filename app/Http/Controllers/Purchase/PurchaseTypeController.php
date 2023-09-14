<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase\PurchaseType;
use Illuminate\Http\Request;

class PurchaseTypeController extends Controller
{
    public function purchaseTypeList()
    {
        $user = PurchaseType::all();
        return view('purchase.purchasetype', ['purchases' => $user]);
    }
    public function addPurchaseTypeForm()
    {
        return view('purchase.addpurchasetype');
    }
    function addPurchaseType(Request $req)
    {
        $req->validate([
            'purchaseType' => 'required'
        ]);
        $user = new PurchaseType;
        $user->purchaseType = $req->purchaseType;
        $user->code= $req->code;
        $user->save();
        return redirect('purchase-type-list')->with('message','Successful! New Purchase Type Created Successfully');
    }
    public function getPurchaseTypeInformation(Request $request)
    {
        $user = PurchaseType::where('id', $request->id)->first();
        return $user;
    }
    function purchasetypedelete(Request $request)
    {
        PurchaseType::where('id', $request->id)->delete();
        return redirect('purchase-type-list')->with('message','Successful! Purchase type Deleted Successfully');
    }
    public function purchaseTypeEdit($id){
        $data = PurchaseType::find($id);
        return view('purchase.updatepurchasetype',['purchase'=>$data]);
    }
    function purchaseTypeUpdate(Request $req){
        $data = PurchaseType::find($req->id);
        $data->purchaseType = $req->purchaseType;
        $data->code = $req->code;
        $data->save();
        return redirect('purchase-type-list')->with('message','Successful! Purchase Type Updated Successfully');
    }
    function purchaseTypeSearch(Request $req)
    {
        $data = PurchaseType::where('purchaseType', 'like', '%' . $req->input('query') . '%')->get();
        return view('purchase.searchpurchasetype', ['purchases' => $data]);
    }
}
