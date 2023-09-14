<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product\Brand;
use App\Models\Product\BModel;

use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function modelList(){
        $data = DB::table('models')
            ->join('brands','models.brandId','=','brands.id')
            ->select('models.*','brands.brandName as brandId')
            ->get();
        return view('product.model.modellist',['models'=>$data]);
    }
    public function addmodelform(){
        $user = Brand::all();
        return view('product.model.addmodel',['user'=>$user]);
    }
    public function addmodel(Request $req){
        $req->validate( [
            'brandId'=> 'required',
            'modelName'=> 'required'
        ]);
        $user = new BModel;
        $user->brandId = $req->brandId;
        $user->modelName = $req->modelName;
        $user->note = $req->note;
        $user->save();
        return redirect('model-list')->with('message','Successful! New Model Created Successfully');
    }
    public function getModelInformation(Request $request){
        $user = BModel::where('id',$request->id)->first();
        return $user;
    }
    function mdelete(Request $request){
        BModel::where('id',$request->id)->delete();
        return redirect('model-list')->with('message','Successful! Model Deleted Successfully');
    }
    public function medit(Request $req){
        $data = BModel::where('id',$req->id)->first();
        $category = Brand::all();
        $show = Brand::where('id',$data->brandId)->first();
        return view('product.model.updatemodel',['user'=> $data,'brands'=>$category,'showname'=>$show]);
    }
    function Mupdate(Request $req){
        $data = BModel::find($req->id);
        $data->brandId = $req->brandId;
        $data->modelName = $req->modelName;
        $data->note = $req->note;
        $data->save();
        return redirect('model-list')->with('message','Successful! Model Updated Successfully');
    }
    function modelSearch(Request $req)
    {
        $data = DB::table('models')
            ->join('brands','models.brandId','=','brands.id')
            ->select('models.*','brands.brandName as brandId')
            ->where('modelName', 'like', '%' . $req->input('query') . '%')
            ->get();
        return view('product.model.searchmodel', ['searchs' => $data]);
    }
}

