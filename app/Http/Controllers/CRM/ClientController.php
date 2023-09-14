<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CRM\Leeds;
use App\Models\Project\ProjectDeal;
use App\Models\Project\ProjectCategory;
use App\Models\User;
class ClientController extends Controller
{
    public function allClient(){
        $deals = ProjectDeal::all();
        $clients = Leeds::all();
        $categories = ProjectCategory::all();
        $users = User::all();
        return view('CRM.client.allClient')->with('deals',$deals)->with('clients',$clients)->with('categories',$categories)->with('users',$users);
    }
}
