<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Purchase\purchase;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allSupplierPaymentDetails()
    {
        $suppliers = Supplier::all();
        return view('Payment.Supplier_payment.paymentDetails',['suppliers'=>$suppliers]);
    }
    public function supplierTransactions($id)
    {
        $supplier = Supplier::where('id',$id)->first();
        $purchases = purchase::where('due','>',0)->where('supplierId',$id)->get();
        return view('Payment.Supplier_payment.supplierTransactionList',['purchases'=>$purchases,'supplier'=>$supplier]);
    }
}
