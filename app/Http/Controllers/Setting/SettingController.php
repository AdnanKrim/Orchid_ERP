<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Models\Settings\BusinessBranch;
use Illuminate\Http\Request;
use App\Models\Settings\CompanyInfo;
use Illuminate\Support\Facades\Bus;

class SettingController extends Controller
{
    public function addCompanyInfo(){
        return view('Setting.add_company_infoTable');
    }
    public function createCompanyInfo(Request $request){
        $companyInfo = new CompanyInfo;
        $companyInfo->companyName = $request->companyName;
        $fileName = $request->file('logo');
        $imageName = $fileName->getClientOriginalName();
        $directory = 'Company-Images/';
        $fileName->move($directory, $imageName);
        $imageUrl = $directory.$imageName;
        $companyInfo->logo = $imageUrl;
        $fileName2 = $request->file('favIcon');
        $imageName2 = $fileName2->getClientOriginalName();
        $directory = 'Company-Images/';
        $fileName2->move($directory, $imageName2);
        $imageUrl2 = $directory.$imageName2;
        $companyInfo->favIcon = $imageUrl2;
//        $fileName = time().$request->file('logo')->getClientOriginalName();
//        $path = $request->file('logo')->storeAs('logo',$fileName,'public');
//        $companyInfo->favicon = '/storage/'.$path;
//        $fileName2 = time().$request->file('favIcon')->getClientOriginalName();
//        $path2 = $request->file('favIcon')->storeAs('favIcon',$fileName2,'public');
//        $companyInfo->favicon = '/storage/'.$path2;
        $companyInfo->phone = $request->phone;
        $companyInfo->email = $request->email;
        $companyInfo->address = $request->address;
        $companyInfo->city = $request->city;
        $companyInfo->state = $request->state;
        $companyInfo->country = $request->country;
        $companyInfo->slogan = $request->slogan;
        $companyInfo->save();
        return redirect('/allCompanyInfo')->with('message','New Company Information Created Successfully');
    }
    public function allCompanyInfoList(){
        $companyInfo = CompanyInfo::all();
        return view('Setting.companyInfo',['companyInfo'=>$companyInfo]);
    }
    public function edit($id)
    {
        $companyInfo = CompanyInfo::find($id);
        return view('Setting.editCompanyInfo',compact('companyInfo'));
    }
    public function update(Request $request,$id)
    {
        $companyInfo = CompanyInfo::find($id);
        if ($logo = $request->file('logo')){
            $fileName = $request->file('logo');
            $imageName = $fileName->getClientOriginalName();
            $directory = 'Company-Images/';
            $fileName->move($directory, $imageName);
            $imageUrl = $directory.$imageName;
            $companyInfo->logo = $imageUrl;
        }else{
            unset($companyInfo['logo']);
        }
        if ($favicon = $request->file('favicon')){
            $fileName2 = $request->file('favIcon');
            $imageName2 = $fileName2->getClientOriginalName();
            $directory = 'Company-Images/';
            $fileName2->move($directory, $imageName2);
            $imageUrl2 = $directory.$imageName2;
            $companyInfo->favIcon = $imageUrl2;
        }else{
            unset($companyInfo['favicon']);
        }
        $companyInfo->companyName = $request->companyName;
        $companyInfo->phone = $request->phone;
        $companyInfo->email = $request->email;
        $companyInfo->address = $request->address;
        $companyInfo->city = $request->city;
        $companyInfo->state = $request->state;
        $companyInfo->country = $request->country;
        $companyInfo->slogan = $request->slogan;
        $companyInfo->save();
        return redirect('/allCompanyInfo')->with('message','Company Information Updated Successfully');
    }
    public function delete(Request $request){
        CompanyInfo::where('id',$request->id)->delete();
        $companyInfo = CompanyInfo::find($request->id);
//        if (file_exists($companyInfo->logo) || file_exists($companyInfo->favicon)){
//            unlink($companyInfo->logo);
//            unlink($companyInfo->favicon);
//        }
//        $companyInfo->delete();
        return redirect('/allCompanyInfo')->with('message','Company Info deleted Successfully');
    }
    public function CompanyInfoSearch(Request $request){
        $companyInfo = CompanyInfo::where('companyName', 'like', '%' . $request->input('query') . '%')->get();
        return view('Setting.searchCompanyInfo',compact('companyInfo'));
//        return view('Setting.searchCompanyInfo', ['$companyInfo' => $data]);
    }
    public function getCategoryInformation(Request $request){
        $user = CompanyInfo::where('id',$request->id)->first();
        return $user;
    }
    public function businessBranch(){
        $businessBranch = BusinessBranch::all();
        return view('Setting.businessBranch',['businessBranch'=>$businessBranch]);
    }
    public function addBusinessBranch(){
        return view('Setting.addBusinessBranch');
    }
    public function createBusinessBranch(Request $request){
//        echo "<pre>";
//        print_r($request->all());
//        die();
        $businessBranch = new BusinessBranch();
        $businessBranch->branchName = $request->branchName;
        $businessBranch->branchHead = $request->branchHead;
        //$businessBranch->companyId = $request->companyId;
        $businessBranch->address = $request->address;
        $businessBranch->city = $request->city;
        $businessBranch->state = $request->state;
        $businessBranch->country = $request->country;
        //$businessBranch->branchLocation = $request->branchLocation;
        $businessBranch->phoneNo = $request->phoneNo;
        $businessBranch->email = $request->email;
        //$businessBranch->status = $request->status;
        $businessBranch->note = $request->note;
        $businessBranch->save();
        return redirect('/business-branch')->with('message','New Business Branch Created Successfully');
    }
    public function businessBranchDel(Request $request){
        $user = BusinessBranch::where('id',$request->id)->first();
        return $user;
    }
    public function deleteBranch(Request $request){
        BusinessBranch::where('id',$request->id)->delete();
        return redirect('/business-branch')->with('message','Business Branch Deleted Successfully');
    }
    public function editBusinessBranch($id){
        $businessBranch = BusinessBranch::find($id);
        return view('Setting.editBusinessBranch',compact('businessBranch'));
    }
    public function updateBusinessBranch(Request $request,$id){
        $businessBranch = BusinessBranch::find($id);
        $businessBranch->branchName = $request->branchName;
        $businessBranch->branchHead = $request->branchHead;
        $businessBranch->companyId = $request->companyId;
        $businessBranch->address = $request->address;
        $businessBranch->city = $request->city;
        $businessBranch->state = $request->state;
        $businessBranch->country = $request->country;
        $businessBranch->branchLocation = $request->branchLocation;
        $businessBranch->phoneNo = $request->phoneNo;
        $businessBranch->email = $request->email;
        $businessBranch->status = $request->status;
        $businessBranch->note = $request->note;
        $businessBranch->save();
        return redirect('/business-branch')->with('message','Business Branch Updated Successfully');
    }
    public function businessBranchSearch(Request $request){
        $branchInfos = BusinessBranch::where('branchName','like','%'.$request->input('query').'%')->get();
        return view('Setting.searchBranchInfo',compact('branchInfos'));
    }
}
