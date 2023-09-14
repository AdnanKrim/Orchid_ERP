<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CRM\Leeds;
use App\Models\Project\ProjectDeal;
use App\Models\Project\ProjectCategory;
use App\Models\User;
class SalesController extends Controller
{
    public function allSales(){
        $deals = ProjectDeal::all();
        $clients = Leeds::all();
        $categories = ProjectCategory::all();
        $users = User::all();
        return view('Sales.salesList')->with('deals',$deals)->with('clients',$clients)->with('categories',$categories)->with('users',$users);
    }
}
