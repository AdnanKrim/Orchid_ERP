<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product\SubCategory;
use App\Models\Product\Category;

use Illuminate\Http\Request;

class SubController extends Controller
{
public function scategoryList(){
//    $data= SubCategory::all();
    $data = DB::table('sub_categories')
        ->join('categories','sub_categories.categoryId','=','categories.id')
        ->select('sub_categories.*','categories.categoryName as categoryId')
        ->get();
    return view('product.subcategory.subcategorylist',['scategory'=>$data]);
}
    public function addScategory(){
        $user = Category::all();
        return view('product.subcategory.addsubcatagory',['user'=>$user]);
    }
public function addScatetory(Request $req){
    $req->validate( [
        'categoryId'=> 'required',
        'subCategoryName'=> 'required'

    ]);
    $user = new SubCategory;
    $user->categoryId = $req->categoryId;
    $user->subCategoryName = $req->subCategoryName;
    $user->subCategoryCode = $req->subCategoryCode;
    $user->note = $req->note;
    $user->save();
    return redirect('s-categorylist')->with('message','Successful! New Sub Category Created Successfully');
}
public function showuptbl(Request $req){
    $data = SubCategory::where('id',$req->id)->first();
    $category = Category::all();
    $show = Category::where('id',$data->categoryId)->first();
    return view('product.subcategory.updatesubcategory',['user'=> $data,'cats'=>$category,'showname'=>$show]);

}
    public function getSubCategoryInformation(Request $request){
        $user = SubCategory::where('id',$request->id)->first();
        return $user;
    }
    function Sdelete(Request $request){
        SubCategory::where('id',$request->id)->delete();
        return redirect('s-categorylist')->with('message','Successful! Sub Category Deleted Successfully');
    }
    function Supdate(Request $req){
        $data = SubCategory::find($req->id);
        $data->categoryId = $req->categoryId;
        $data->subCategoryName = $req->subCategoryName;
        $data->subCategoryCode= $req->subCategoryCode;
        $data->note = $req->note;
        $data->save();
        return redirect('s-categorylist')->with('message','Successful! Sub Category Updated Successfully');
    }
    function subCategorySearch(Request $req)
    {
        $data =DB::table('sub_categories')
            ->join('categories','sub_categories.categoryId','=','categories.id')
            ->select('sub_categories.*','categories.categoryName as categoryId')
            ->where('subCategoryName', 'like', '%' . $req->input('query') . '%')
            ->get();
        return view('product.subcategory.searchsubcategory', ['searchs' => $data]);


    }

}
