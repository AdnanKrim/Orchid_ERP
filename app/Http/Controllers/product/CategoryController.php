<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use App\Models\Product\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList(){
        $data = Category::all();
        return view('product.category.catagoryList',['category'=> $data]);
    }
    function catagory(){
        return view('product.category.addProductCatagory');
    }
    function addCategory(Request $req){
        $req->validate( [
            'categoryName'=> 'required'
        ]);
        $user = new Category;
        $user->categoryName = $req->categoryName;
        $user->categoryCode = $req->categoryCode;
        $user->note = $req->note;
        $user->save();
        return redirect('categoryList')->with('message','Successful! New Category Created Successfully');
//        return redirect('categoryList')->with('message','New Category Created Successfully');
    }
    function show($id){
        $data = Category::find($id);
        return view('product.category.updateproductcategory',['data'=>$data]);
    }
    public function getCategoryInformation(Request $request){
        $user = Category::where('id',$request->id)->first();
        return $user;
    }
    function delete(Request $request){
        Category::where('id',$request->id)->delete();
        return redirect('categoryList')->with('message','Successful! Category Info deleted Successfully');
    }
    function update(Request $req){
        $data = Category::find($req->id);
        $data->categoryName = $req->categoryName;
        $data->categoryCode = $req->categoryCode;
        $data->note = $req->note;
        $data->save();
        return redirect('categoryList')->with('message','Successful! Category Updated Successfully');
    }
    function categorySearch(Request $req)
    {
        $data = Category::where('categoryName', 'like', '%' . $req->input('query') . '%')->get();
        return view('product.category.searchcategory', ['searchs' => $data]);
    }
}
