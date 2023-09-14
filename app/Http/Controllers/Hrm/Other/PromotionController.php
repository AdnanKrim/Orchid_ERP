<?php

namespace App\Http\Controllers\Hrm\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRMS\Promotion;
use App\Models\User;
class PromotionController extends Controller
{
    public function addPromotion(){
        $users = User::all();
        return view('Hrm.Others.Promotion.addPromotion')->with('users',$users);
    }
    public function promotionList(){
        $users = User::all();
        $promotions = Promotion::all();
        return view('Hrm.Others.Promotion.promotionList')->with('promotions',$promotions)->with('users',$users);
    }
    public function addPromotionPost(Request $request){
        $promotion = new Promotion();
        $promotion->Employee = $request->employee;
        $promotion->Title = $request->ptitle;
        $promotion->PromotionDate  = $request->pdate;
        $promotion->Description = $request->description;
        $promotion->save();
        return  redirect()->route('promotionList')->with('Create_Message', 'New promotion added successfully');
    }
    public function promotionInfo(Request $request){
        $promotion = Promotion::where('id',$request->id)->first();
        return $promotion;
    }
    public function promotionDelete(Request $request){
        $promotion = Promotion::where('id',$request->id)->delete();
        return  redirect()->route('promotionList')->with('Delete_Message', 'Promotion deleted successfully');
    }
    public function getPromotion(Request $request){
        $promotion = Promotion::where('id',$request->id)->first();
        $users = User::all();
        $userName = User::where('id',$promotion->Employee)->first();
        return  view('Hrm.Others.Promotion.updatePromotion')->with('promotion',$promotion)->with('users',$users)->with('userName',$userName);
    }
    public function updatePromotion(Request $request){
        $promotion = Promotion::where('id',$request->id)->first();
        $promotion->Employee = $request->employee;
        $promotion->Title = $request->ptitle;
        $promotion->PromotionDate  = $request->pdate;
        $promotion->Description = $request->description;
        $promotion->save();
        return  redirect()->route('promotionList')->with('Update_Message', 'New promotion added successfully');
    }

}
