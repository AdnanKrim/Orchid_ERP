<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Stock;
use App\Models\Inventory\StockAdjustment;
use App\Models\Product\Product;
use App\Models\Settings\BusinessBranch;
use App\Models\User;
use Illuminate\Http\Request;

class stockAdjustmentController extends Controller
{
    public function addstockAdjust(){
        $branches = BusinessBranch::all();
        $products = Product::all();
        return view('Inventory.stockAdjustment.addstockAdjustment')->with('branches',$branches)->with('products',$products);
    }
    public function stockSearch(Request $request){
        $stock = Stock::where('productId',$request->ProductId)->first();
        return $stock;
    }
    public function addstockAdjustPost(Request $request){
        $stockAdjust = new StockAdjustment();
        $stockAdjust->Date = $request->date;
        $stockAdjust->Branch = $request->branch;
        $stockAdjust->AdjustmentType = $request->adjustmentType;
        $stockAdjust->Reason = $request->reason;
        $stockAdjust->Product = $request->productName;
        $stockAdjust->AvailableStock = $request->availableStock;
        $stockAdjust->NewStock = $request->newStock;
        $stockAdjust->AdjustmentQuantity = $request->adjustmentQuantity;
        $stockAdjust->Operator = $request->operator;
        $stockAdjust->TotalAmount = $request->totalAmount;
        $stockAdjust->Note = $request->note;
        $stockAdjust->AdjustedBy = auth()->user()->id;;
        $res = $stockAdjust->save();
        if ($res){
            return  redirect()->route('stockAdjustList')->with('Create_Message', 'Holiday deleted successfully');
        }
    }
    public function stockAdjustList(){
        $branches = BusinessBranch::all();
        $products = Product::all();
        $stocks = StockAdjustment::all();
        $users = User::all();
        return view('Inventory.stockAdjustment.stockAdjustmentList')->with('branches',$branches)->with('products',$products)->with('stocks',$stocks)->with('users',$users);
    }
    public function stockAdjustInfo(Request $request){
        $stocks = StockAdjustment::where('id',$request->id)->first();
        return $stocks;
    }
    public function stockAdjustDelete(Request $request){
        $stocks = StockAdjustment::where('id',$request->id)->delete();
        return  redirect()->route('stockAdjustList')->with('Delete_Message', 'Holiday deleted successfully');
    }
    public function getStockAdjust(Request $request){
        $stock = StockAdjustment::where('id',$request->id)->first();
        $branches = BusinessBranch::all();
        $branchName = BusinessBranch::where('id',$stock->Branch)->first();
        $products = Product::all();
        $productName = Product::where('id',$stock->Product)->first();
        return view('Inventory.stockAdjustment.updateStockAdjustment')->with('branches',$branches)->with('branchName',$branchName)->with('products',$products)->with('productName',$productName)->with('stock',$stock);
    }
    public function UpdatestockAdjust(Request $request){
        $stockAdjust = StockAdjustment::where('id',$request->id)->first();
        $stockAdjust->Date = $request->date;
        $stockAdjust->Branch = $request->branch;
        $stockAdjust->AdjustmentType = $request->adjustmentType;
        $stockAdjust->Reason = $request->reason;
        $stockAdjust->Product = $request->productName;
        $stockAdjust->AvailableStock = $request->availableStock;
        $stockAdjust->NewStock = $request->newStock;
        $stockAdjust->AdjustmentQuantity = $request->adjustmentQuantity;
        $stockAdjust->Operator = $request->operator;
        $stockAdjust->TotalAmount = $request->totalAmount;
        $stockAdjust->Note = $request->note;
        $stockAdjust->AdjustedBy = auth()->user()->id;
        $res = $stockAdjust->save();
        if ($res){
            return  redirect()->route('stockAdjustList')->with('Update_Message', 'Holiday deleted successfully');
        }
    }
    function stockAdjustSearch(Request $req)
    {
        $productName = Product::where('productName', 'like', '%' . $req->input('query') . '%')->first();
        $stocks = StockAdjustment::where('Product', $productName->id)->get();
        $users = User::all();
        $branches = BusinessBranch::all();
        $products = Product::all();
        return view('Inventory.stockAdjustment.searchStockAdjustment')->with('products',$products)->with('users',$users)->with('branches',$branches)->with('stocks',$stocks);
    }
}
