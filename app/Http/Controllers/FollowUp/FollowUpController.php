<?php

namespace App\Http\Controllers\FollowUp;

use App\Http\Controllers\Controller;
use App\Models\FollowUp\SmsHistory;
use App\Models\FollowUp\SmsTemplate;
use Illuminate\Http\Request;
use App\Models\FollowUp\FollowUpGroup;
use App\Models\FollowUp\emailTemplate;
use App\Models\FollowUp\emailHistory;
use App\Models\FollowUp\WatsappTemplate;
use App\Models\FollowUp\WatsappHistory;
use App\Models\Supplier\Supplier;
use App\Models\CRM\Leeds;


use Illuminate\Support\Facades\Http;
use Mail;

class FollowUpController extends Controller
{
    public function emailTemplate(){
        $template = emailTemplate::all();
        return view('FollowUp.Email.emailtemplate',['templates'=>$template]);
    }
    public function addEmailTempForm(){
        $user = FollowUpGroup::all();
        return view('FollowUp.Email.addemailtemp',['user'=>$user]);
    }
    public function addEmailTemplate(Request $req){
        $req->validate( [
            'groupId'=> 'required',

        ]);
        $user = new emailTemplate();
        $user->groupId = $req->groupId;
        $user->subject = $req->subject;
        $user->body = $req->body;
        $user->save();
        return redirect('email-template')->with('message','Successful! New Email Template Created Successfully');
    }
    public function getEmailInformation(Request $request){
        $user = emailTemplate::where('id',$request->id)->first();
        return $user;
    }
    function emailTemplateDelete(Request $request){
        emailTemplate::where('id',$request->id)->delete();
        return redirect()->back()->with('message','Successful! Email Template Deleted Successfully');
    }
    public function emailTemplateSearch(Request $request){

    }
    public function editEmailTemplate(Request $req){
        $template = emailTemplate::where('id',$req->id)->first();
        $user = FollowUpGroup::all();
        return view('FollowUp.Email.updateemailtemp',['user'=>$user,'temp'=>$template]);

    }
    public function updateEmailTemplate(Request $req){
        $req->validate( [
            'groupId'=> 'required',

        ]);
        $user = emailTemplate::find($req->id);
        $user->groupId = $req->groupId;
        $user->subject = $req->subject;
        $user->body = $req->body;
        $user->save();
        return redirect('email-template')->with('message','Successful! New Email Template Updated Successfully');
    }
    public function sendEmailForm(Request $req){
        $temp = emailTemplate::find($req->id);
        $group = FollowUpGroup::where('id',$temp->groupId)->first();
        if($group->groupToken === 'suppliers'){
            $supp = Supplier::all();
        }
        if($group->groupToken === 'all-leeds'){
            $supp = Leeds::where('isSuccess',0)->get();
        }
        if($group->groupToken === 'success-leeds'){
            $supp = Leeds::where('isSuccess',1)->get();

        }
        return view('FollowUp.Email.sendemailform',['temp'=>$temp,'supp'=>$supp]);
    }

    public function emailBody(){
        return view('FollowUp.Email.emailbody');
    }

    public function sendEmail(Request $request)
    {
        $emails = $request->email;
        $subject = $request->subject;
        $body = $request->body;
        $file = $request->file('attachment');
        if($file != null) {
            $fileName = $request->file('attachment')->getClientOriginalName();

            Mail::send('FollowUp.Email.emailbody', ['msg' => $body, 'sub' => $subject],
                function ($message) use ($emails, $subject, $fileName, $file) {
                    $message
                        ->to($emails)
                        ->subject($subject)
                        ->attach($file,['as'=>$fileName]);


                });
        }
        if($file === null){
            Mail::send('FollowUp.Email.emailbody', ['msg' => $body, 'sub' => $subject],
                function ($message) use ($emails, $subject,) {
                    $message
                        ->to($emails)
                        ->subject($subject);

                });
        }
            emailHistory::create([
                'templateId'=>$request->templateId,
                'subject'=> $request->subject,
                'body'=>$request->body,
                'email'=>json_encode($request->email),
            ]);

        return redirect('email-template')->with('message','Successful! New Email Sent Successfully');

//        return ($emails);
    }
//    Email History
public function emailHistory(){
        $data = emailHistory::orderBy('id','desc')->get();
        return view('FollowUp.Email.emailhistory',['histories'=>$data]);
}
//SMS
    public function smsTemplate(){
        $template = SmsTemplate::all();
        return view('FollowUp.SMS.smstemplate',['templates'=>$template]);
    }
    public function addSmsTempForm(){
        $user = FollowUpGroup::all();
        return view('FollowUp.SMS.addsmstemp',['user'=>$user]);
    }
    public function addSmsTemplate(Request $req){
        $req->validate( [
            'groupId'=> 'required',

        ]);
        $user = new SmsTemplate();
        $user->groupId = $req->groupId;
        $user->message = $req->message;
        $user->save();
        return redirect('sms-template')->with('message','Successful! New SMS Template Created Successfully');
    }
    public function sendSmsForm(Request $req){
        $temp = SmsTemplate::find($req->id);
        $group = FollowUpGroup::where('id',$temp->groupId)->first();
        if($group->groupToken === 'suppliers'){
            $supp = Supplier::all();
        }
        if($group->groupToken === 'all-leeds'){
            $supp = Leeds::where('isSuccess',0)->get();
        }
        if($group->groupToken === 'success-leeds'){
            $supp = Leeds::where('isSuccess',1)->get();

        }
        return view('FollowUp.SMS.sendsmsform',['temp'=>$temp,'supp'=>$supp]);
    }
     public function sendSMS(Request $req){

//         if(count($req->phoneNo)> 1){
////             $url = config('services.bulksmsbd.multi_user_url');
//             $url = config('services.bulksmsbd.single_user_url');
//         } else{
//             $url = config('services.bulksmsbd.single_user_url');
//         }
         $url = config('services.bulksmsbd.single_user_url');


         $response = Http::post($url, [
                "api_key" => config('services.bulksmsbd.api_key'),
                "senderid" => config('services.bulksmsbd.sender_id'),
                "number" => implode (",", $req->phoneNo),
                "message" => $req->body
         ]);
//         SmsHistory::create([
//             'templateId'=>$req->templateId,
//             'message'=>$req->body,
//             'phoneNo'=>json_encode($req->phoneNo),
//         ]);

//       $a = config('services.bulksmsbd.api_key');
//       $b = config('services.bulksmsbd.sender_id');
//       $c = implode (",", $req->phoneNo);
//       $d = $req->body;
         return $response ;


     }
    public function getSMSInformation(Request $request){
        $user = SmsTemplate::where('id',$request->id)->first();
        return $user;
    }
    function SMSTemplateDelete(Request $request){
        SmsTemplate::where('id',$request->id)->delete();
        return redirect()->back()->with('message','Successful! SMS Template Deleted Successfully');
    }
    public function SMSTemplateSearch(Request $request){

    }
    public function editSmsTemplate(Request $req){
        $template = SmsTemplate::where('id',$req->id)->first();
        $user = FollowUpGroup::all();
        return view('FollowUp.SMS.updatesmstemp',['user'=>$user,'temp'=>$template]);

    }
    public function updateSmsTemplate(Request $req){
        $req->validate( [
            'groupId'=> 'required',

        ]);
        $user = SmsTemplate::find($req->id);
        $user->groupId = $req->groupId;
        $user->message = $req->message;
        $user->save();
        return redirect('sms-template')->with('message','Successful! New SMS Template Updated Successfully');
    }
    public function SMSHistory(){
        $data = SmsHistory::orderBy('id','desc')->get();
        return view('FollowUp.SMS.SMShistory',['histories'=>$data]);
    }
    //Watsapp
    public function watsappTemplate(){
        $template = WatsappTemplate::all();
        return view('FollowUp.Watsapp.watsapptemplate',['templates'=>$template]);
    }
    public function addWatsappTempForm(){
        $user = FollowUpGroup::all();
        return view('FollowUp.Watsapp.addwatsapptemp',['user'=>$user]);
    }
    public function addWatsappTemplate(Request $req){
        $req->validate( [
            'groupId'=> 'required',

        ]);
        $user = new WatsappTemplate();
        $user->groupId = $req->groupId;
        $user->message = $req->message;
        $user->save();
        return redirect('watsapp-template')->with('message','Successful! New Watsapp Template Created Successfully');
    }
    public function sendMessageForm(Request $req){
        $temp = WatsappTemplate::find($req->id);
        $group = FollowUpGroup::where('id',$temp->groupId)->first();
        if($group->groupToken === 'suppliers'){
            $supp = Supplier::all();
        }
        if($group->groupToken === 'all-leeds'){
            $supp = Leeds::where('isSuccess',0)->get();
        }
        if($group->groupToken === 'success-leeds'){
            $supp = Leeds::where('isSuccess',1)->get();

        }
        return view('FollowUp.Watsapp.sendwatsappform',['temp'=>$temp,'supp'=>$supp]);
    }
    public function editWatsappTemplate(Request $req){
        $template = WatsappTemplate::where('id',$req->id)->first();
        $user = FollowUpGroup::all();
        return view('FollowUp.Watsapp.updatewatsapptemp',['user'=>$user,'temp'=>$template]);

    }
    public function updateWatsappTemplate(Request $req){
        $req->validate( [
            'groupId'=> 'required',

        ]);
        $user = WatsappTemplate::find($req->id);
        $user->groupId = $req->groupId;
        $user->message = $req->message;
        $user->save();
        return redirect('watsapp-template')->with('message','Successful! New Watsapp Template Updated Successfully');
    }
}
