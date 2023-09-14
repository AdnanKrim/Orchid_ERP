<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\StockTransfer;
use App\Models\Product\Product;
use App\Models\Settings\BusinessBranch;
use App\Models\User;
use Illuminate\Http\Request;

class stockTransferController extends Controller
{
    public function stockTransfer(){
        $products = Product::all();
        $branches = BusinessBranch::all();
        return view('Inventory.StockTransfer.addStockTransfer')->with('products',$products)->with('branches',$branches);
    }
    public function stockTransferPost(Request $request){
        $stock = new StockTransfer();
        $stock->Date = $request->date;
        $stock->From = $request->from;
        $stock->To = $request->to;
        $stock->Product = $request->productName;
        $stock->AvailableStock = $request->availableStock;
        $stock->TransferQuantity = $request->transferQuantity;
        $stock->TotalAmount = $request->totalAmount;
        $stock->ShippingCharge = $request->shippingCharge;
        $stock->Note = $request->note;
        $stock->TransferredBy = auth()->user()->id;
        $stock->save();
        return  redirect()->route('stockTransferList')->with('Create_Message', 'Holiday deleted successfully');
    }
    public function stockTransferList(){
        $products = Product::all();
        $branches = BusinessBranch::all();
        $stocks = StockTransfer::all();
        $users = User::all();
        return view('Inventory.StockTransfer.stockTransferList')->with('products',$products)->with('branches',$branches)->with('stocks',$stocks)->with('users',$users);
    }
    public function stockTransferInfo(Request $request){
        $stocks = StockTransfer::where('id',$request->id)->first();
        return $stocks;
    }
    public function stockTransferDelete(Request $request){
        $stocks = StockTransfer::where('id',$request->id)->delete();
        return  redirect()->route('stockTransferList')->with('Delete_Message', 'Holiday deleted successfully');
    }
    public function getstockTransfer(Request $request){
        $stock = StockTransfer::where('id',$request->id)->first();
        $branches = BusinessBranch::all();
        $From = BusinessBranch::where('id',$stock->From)->first();
        $To = BusinessBranch::where('id',$stock->To)->first();
        $products = Product::all();
        $productName = Product::where('id',$stock->Product)->first();
        return view('Inventory.StockTransfer.updateStockTransfer')->with('branches',$branches)->with('From',$From)->with('To',$To)->with('products',$products)->with('productName',$productName)->with('stock',$stock);
    }
    public function stockTransferUpdate(Request $request){
        $stock = StockTransfer::where('id',$request->id)->first();
        $stock->Date = $request->date;
        $stock->From = $request->from;
        $stock->To = $request->to;
        $stock->Product = $request->productName;
        $stock->AvailableStock = $request->availableStock;
        $stock->TransferQuantity = $request->transferQuantity;
        $stock->TotalAmount = $request->totalAmount;
        $stock->ShippingCharge = $request->shippingCharge;
        $stock->Note = $request->note;
        $stock->TransferredBy = auth()->user()->id;
        $stock->save();
        return  redirect()->route('stockTransferList')->with('Update_Message', 'Holiday deleted successfully');
    }
    function stockTransferSearch(Request $req)
    {
        $productName = Product::where('productName', 'like', '%' . $req->input('query') . '%')->first();
        $stocks = StockTransfer::where('Product', $productName->id)->get();
        $users = User::all();
        $branches = BusinessBranch::all();
        $products = Product::all();
        return view('Inventory.StockTransfer.searchStockTransfer')->with('products',$products)->with('users',$users)->with('branches',$branches)->with('stocks',$stocks);
    }
}
