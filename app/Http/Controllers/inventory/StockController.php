<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Models\Purchase\purchase;
use App\Models\Inventory\Stock;

class StockController extends Controller
{
    public function createStock(){
        $purchases = purchase::orderBy('id','desc')->where('status',2)->first();
        $stock_old = Stock::orderBy('id','desc')->first();

//        $productsId = [];
//        $productsQty = [];
//        $productsRate = [];
//        $itemPrice = [];
//        $data = [];

//            foreach ($purchases as $sl => $purchase) {
        if($stock_old != null) {
            if ($purchases->id != $stock_old->purchase_Id) {

                foreach (json_decode($purchases->products) as $key => $pro) {
//                $productsId[] = $pro->productId;
//                $productsQty[] = $pro->quantity;
//                $productsRate[] = $pro->rate;
//                $itemPrice[] = $productsQty[$key] * $productsRate[$key];
                    $amt =
                    $amount = Stock::where('productId', $pro->productId)->first();
                    $amt = Stock::where('productId', $pro->productId)->exists();
                    if ($amt) {
                        $user = Stock::find($amount->id);
                        $user->purchase_Id = $purchases->id;
                        $user->stockInHand = $amount->stockInHand + $pro->quantity;
                        $user->average = ($amount->stockPurchaseValue + ($pro->quantity * $pro->rate))/( $amount->stockInHand + $pro->quantity);
                        $user->stockPurchaseValue = $amount->stockPurchaseValue + ($pro->quantity * $pro->rate);
                        $user->save();

                    } else {
                        $data[] = Stock::create([
                            'purchase_Id' => $purchases->id,
                            'productId' => $pro->productId,
                            'stockInHand' => $pro->quantity,
                             'average'=> ($pro->quantity * $pro->rate)/$pro->quantity,
                            'stockPurchaseValue' => $pro->quantity * $pro->rate
                        ]);
                    }

                }

            }
        }
if($stock_old === null){
    foreach (json_decode($purchases->products) as $key => $pro) {

            $data[] = Stock::create([
                'purchase_Id' => $purchases->id,
                'productId' => $pro->productId,
                'stockInHand' => $pro->quantity,

                'stockPurchaseValue' => $pro->quantity * $pro->rate
            ]);

    }

}

       return redirect('purchase-total');

    }
    public function stockList(){
        $products = Product::all();
        $stocks = Stock::all();
        return view('Inventory.stockList')->with('products',$products)->with('stocks',$stocks);
    }
}
