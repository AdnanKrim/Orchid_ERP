<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project\ProjectCategory;

class ProjectCategoryController extends Controller
{
    public function addCategory()
    {
        return view('Project.projectCategory.addCategory');
    }
    public function createCategory(Request $request)
    {
        $validate = $request->validate([
            'projectCategoryName'=>'required',
            'projectCategoryCode'=>'required',
        ]);
        $category = new ProjectCategory;
        $category->projectCategoryName = $request->projectCategoryName;
        $category->projectCategoryCode = $request->projectCategoryCode;
        $category->save();
        return  redirect()->route('all-Project-Categories')->with('Create_Message', 'Project successfully');
    }
    public function allCategory()
    {
        $categories = ProjectCategory::orderBy('id', 'desc')->get();
        return view('Project.projectCategory.allCategory', ['categories'=> $categories]);
    }
    public function CategoryInfo(Request $request){
        $category = ProjectCategory::where('id',$request->id)->first();
        return $category;
    }
    public function categoryDelete(Request $request){
        $category = ProjectCategory::where('id',$request->id)->delete();
        return  redirect()->route('all-Project-Categories')->with('Delete_Message', 'Project successfully');
    }
    public function getCategory(Request $request){
        $category = ProjectCategory::where('id',$request->id)->first();
        return  view('Project.projectCategory.updateCategory')->with('category',$category);
    }
    public function updateCategory(Request $request)
    {
        $category = ProjectCategory::where('id',$request->id)->first();
        $category->projectCategoryName = $request->projectCategoryName;
        $category->projectCategoryCode = $request->projectCategoryCode;
        $category->save();
        return  redirect()->route('all-Project-Categories')->with('Update_Message', 'Project successfully');
    }
}
