<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\ExpCategory;
use Illuminate\Http\Request;

class ExpCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addCategory()
    {
        return view('Expense.Category.addCategory');
    }
    public function createCategory(Request $request)
    {
        $category = new ExpCategory();
        $category->name = $request->name;
        $category->code = $request->code;
        $category->save();
        return redirect('all-exp-category')->with('message','New Expense Category Created Successfully!');
    }
    public function allCategory()
    {
        $categories = ExpCategory::all();
        return view('Expense.Category.allCategory',['categories'=>$categories]);
    }
    public function editCategory($id)
    {
        $category = ExpCategory::where('id',$id)->first();
        return view('Expense.Category.editCategory',['category'=>$category]);
    }
    public function updateCategory(Request $request, $id)
    {
        $category = ExpCategory::where('id',$id)->first();
        $category->name = $request->name;
        $category->code = $request->code;
        $category->save();
        return redirect('all-exp-category')->with('message','Expense Category Updated Successfully!');
    }
    public function deleteCategory($id)
    {
        $category = ExpCategory::where('id',$id)->first();
        $category->delete();
        return redirect('all-exp-category')->with('message','Expense Category Deleted Successfully!');
    }
}
