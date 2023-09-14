<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CRM\Leeds;
use App\Models\Project\ProjectDeal;
use App\Models\Project\ProjectCategory;
use App\Models\User;
use App\Models\Settings\BusinessBranch;
use App\Helpers\Helper;
class ProjectDealController extends Controller
{
    public function addDeal(){
        $clients = Leeds::all();
        $businessName = BusinessBranch::all();
        $categories = ProjectCategory::all();
        return view('Project.projectDeal.addDeal')->with('clients',$clients)->with('categories',$categories)->with('businessName',$businessName);
    }
    public function addDealPost(Request $request){
//        echo"<pre>";
//        print_r($request->all());
//        die();
        $project_Id = Helper::IdGenerator(new ProjectDeal,'projectInvoice',5,'PD');
        $validate = $request->validate([
            'start'=>'required',
            'end'=>'required',
            'category'=>'required',
            'client'=>'required',
            'totalAmount'=>'required'
        ]);
        $deal = new ProjectDeal();
        $deal->startDate = $request->start;
        $deal->category = $request->category;
        $deal->endDate = $request->end;
        $deal->projectInvoice = $project_Id;
        $deal->duration = $request->duration;
        $deal->projectName = $request->projectName;
        $deal->branchId = $request->branchId;
        $deal->clientId = $request->client;
        $deal->amount = $request->totalAmount;
        $deal->comment = $request->comment;
        $deal->status = "Running";
        $deal->save();
        return  redirect()->route('allDeal')->with('Create_Message', 'Project successfully');
    }
    public function allDeal(){
        $deals = ProjectDeal::all();
        $clients = Leeds::all();
        $categories = ProjectCategory::all();
        return view('Project.projectDeal.allDeal')->with('deals',$deals)->with('clients',$clients)->with('categories',$categories);
    }
    public function allProjectList(){
        $deals = ProjectDeal::all();
        $clients = Leeds::all();
        $categories = ProjectCategory::all();
        $users = User::all();
        return view('Project.allProjectList')->with('deals',$deals)->with('clients',$clients)->with('categories',$categories)->with('users',$users);
    }
    public function DealInfo(Request $request){
        $deal = ProjectDeal::where('id',$request->id)->first();
        return $deal;
    }
    public function dealDelete(Request $request){
        $deal = ProjectDeal::where('id',$request->id)->delete();
        return  redirect()->route('allDeal')->with('Delete_Message', 'Project successfully');
    }
    public function getDeal(Request $request){
        $deal = ProjectDeal::where('id',$request->id)->first();
        $clients = Leeds::all();
        $categories = ProjectCategory::all();
        $clientName = Leeds::where('id',$deal->ClientName)->first();
        $categoryName = ProjectCategory::where('id',$deal->category)->first();
        return  view('Project.projectDeal.updateDeal')->with('deal',$deal)->with('clients',$clients)->with('categories',$categories)->with('categoryName',$categoryName)->with('clientName',$clientName);
    }
    public function updateDealPost(Request $request){
        $deal = ProjectDeal::where('id',$request->id)->first();
        $deal->startDate = $request->start;
        $deal->endDate = $request->end;
        $deal->duration = $request->duration;
        $deal->category = $request->category;
        $deal->ClientName = $request->client;
        $deal->amount = $request->totalAmount;
        $deal->comment = $request->comment;
        $deal->save();
        return  redirect()->route('allDeal')->with('Update_Message', 'Project successfully');
    }
    public function statusUpdate(Request $request){
        $deal = ProjectDeal::where('id',$request->id)->first();
        $deal->Status = $request->status;
        $deal->save();
        return "Successfull";
    }
}
