<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function projectSell(){
        return view('CRM.payment.projectsellamountlist');
    }
}
