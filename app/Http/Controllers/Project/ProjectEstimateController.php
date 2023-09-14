<?php
namespace App\Http\Controllers\Project;
use App\Models\Project\ProjectEstimate;
use App\Http\Controllers\Controller;
use App\Models\Project\ProjectDeal;
use App\Models\CRM\Leeds;
use App\Models\Settings\BusinessBranch;
use PDF;
use Mail;
use Illuminate\Http\Request;

class ProjectEstimateController extends Controller
{
    public function addEstimate(){
        return view('Project.projectEstimate.addProjectEstimate');
    }
    public function projectEstimateList(){
        $estimates = ProjectEstimate::all();
        return view('Project.projectEstimate.projectestimatelist',['estimates'=>$estimates]);
    }
    public function getDuration(){
        $duration = request('id');
        $data = ProjectDeal::where('id',$duration)->first();
        return response()->json($data);
    }
    public function getName(){
        $id = request('id');
        $data = BusinessBranch::where('id',$id)->first();
        return response()->json($data);
    }
    public function getProjectName(){
        $user = request('id');
        $data = ProjectDeal::where('clientId',$user)->get();
        return response()->json($data);
    }
    public function getBranch(){
        $data = BusinessBranch::all();
        return response()->json($data);
    }
    public function getProject(){
        //return request()->all();
        $t = [];
        $v=[];
        $clientsP = ProjectDeal::all();
        foreach ($clientsP as $client){
            $v[] = Leeds::Where('id',$client->clientId)->first();
        }
        $t = array_unique($v);
        return response()->json($t);
    }
    public function getProjectEstimateInformation(Request $request){
        $user = ProjectEstimate::where('id',$request->id)->first();
        return $user;
    }
    function projectEstimateDelete(Request $request){
        ProjectEstimate::where('id',$request->id)->delete();
        return redirect()->back()->with('message','Successful! Project Estimate Deleted Successfully');
    }
    public function projectEstimateSearch(Request $request){

    }
//    public function getProjectEstimate(){
//        //$data = ProjectDeal::all();
//        $c = [];
//        $clientsP = ProjectDeal::all();
//        foreach ($clientsP as $client){
//            $c[] = ProjectDeal::where('id',$client->clientId)->first();
//        }
//        return response()->json($c);
//    }
    public function storeEstimate(Request $req) {
        $estimate = new ProjectEstimate;
        $estimate->clientId = $req->clientId;
        $estimate->date = $req->date;
        $estimate->branchId = $req->branchId;
        $estimate->projectId = $req->projectId;
        $estimate->products = json_encode($req->products);
        $estimate->grandTotal = $req->total;
        $estimate->save();
        return response('project-estimate-list');
    }
    public Function projectEstimatePDF(Request $req){
        $estimate= ProjectEstimate::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$estimate->clientId)->first();
        $project = ProjectDeal::where('id',$estimate->projectId)->first();
        $branch = BusinessBranch::where('id',$estimate->branchId)->first();
        $pdf = PDF::loadview('Project.projectEstimate.projectestimatePDF',['project'=>$project,'estimate'=>$estimate,'leeds'=>$leeds,'branch'=>$branch]);
        return $pdf->setPaper('a4', 'letter')->setWarnings(false)->stream("view_project_estimate.pdf");
    }
    public Function projectEstimateDwnPDF(Request $req){
        $estimate= ProjectEstimate::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$estimate->clientId)->first();
        $project = ProjectDeal::where('id',$estimate->projectId)->first();
        $branch = BusinessBranch::where('id',$estimate->branchId)->first();
        $pdf = PDF::loadview('Project.projectEstimate.projectestimatePDF',['project'=>$project,'estimate'=>$estimate,'leeds'=>$leeds,'branch'=>$branch]);
        return $pdf->download("view_project_estimate.pdf");
    }
    public Function projectEstimateMailPDF(Request $req){
        $estimate= ProjectEstimate::where('id',$req->id)->first();
        $leeds = Leeds::where('id',$estimate->clientId)->first();
        $project = ProjectDeal::where('id',$estimate->projectId)->first();
        $branch = BusinessBranch::where('id',$estimate->branchId)->first();
        $pdf = PDF::loadview('Project.projectEstimate.projectestimatePDF',['project'=>$project,'estimate'=>$estimate,'leeds'=>$leeds,'branch'=>$branch]);
        Mail::send('Project.projectEstimate.projectestimatePDF',['project'=>$project,'estimate'=>$estimate,'leeds'=>$leeds,'branch'=>$branch],
            function ($message) use ($leeds, $pdf){
                $message
                    ->to($leeds->email)
                    ->subject('Project estimate Invoice')
                    ->attachData($pdf->output(),'view_project_estimate.pdf');
            });
        return redirect()->back()->with('message','Successful! Email Sent Successfully');
    }

}
