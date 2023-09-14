<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\Leeds;
use Illuminate\Http\Request;
use App\Models\CRM\deed;
use http\Env\Response;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\DB;

class DeedController extends Controller
{
//$des = DesignWork::all()->first();
//if(empty($des)){
//$design = "empty";
//}
//else{
//    $design = $des;
//}
private $leed;
    public function allDeed($id){
        $leeds = Leeds::find($id);
        $files = Deed::where('leedId',$id)->get();
        if(empty($files)){
            $files = "empty";
        }
        else{
            $files = $files;
        }
        return view('CRM.Deed.deed',['leed'=>$leeds,'files'=>$files]);
    }
    public function deedGoCreate($id){
        $leeds = Leeds::find($id);
        return view('CRM.Deed.deedGoCreate',['leed'=>$leeds]);
    }
    public function deedCreate(Request $request,$id){
//        $this->validate($request, [
//            'files' => 'required',
//            'files.*' => 'mimes:doc,pdf,docx,zip,jpg,jpeg,gif,xls,png'
//        ]);
        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $file)
            {
                $leeds = Leeds::find($id);
                $deed = new deed;
                $name = time().rand(1,100).'.'.$file->extension();
                                //echo "<pre>";
                //print_r($name);

                $file->move(public_path('Deed'), $name);
//                $directory = 'Deed/';
//                $file->move($directory, $name);
 //               $files = $name;
                $deed->file = $name;
                $deed->leedId = $request->leedId;
                $deed->save();
            }
            $this->leed = Leeds::find($id);
            //die();
            if ($this->leed->isClient == 0)
            {
                $this->leed->isClient = 1;
                $this->message = 'Updated To Success Leed';
            }
            else
            {
                $this->leed->isClient = 0;
                $this->message = 'Updated To Leed';
            }
            $this->leed->save();
        }
        //$deed->file = json_encode($files);
        //$deed->leedId = $request->leedId;
       // $deed->save();
        return redirect()->route('allDeed',['id'=>$leeds->id])->with('message','File Created Successfully');

    }
//    public function deleteMeasurement($index, $id)
//{
//    $file = Measurement::find($id);
//    $path = public_path().'/measure-files/';
////        if (file_exists(public_path('measure-file/'.$file->name)))
////        {
////            unlink(public_path('measure-files/'.$file->name));
////        }
//    Storage::delete($path.$file->files);
//    $filesD = json_decode($file->files);
//    array_splice($filesD, $index, 1);
//    Measurement::where('id', $id)->update(['files'=>json_encode($filesD)]);
//    return redirect()->back()->with('Delete_Message', 'File Removed successfully');
//}
//CompanyInfo::where('id',$request->id)->delete();


    public function deletedeed($id)
    {
        $leeds = Leeds::find($id);
       $file = Deed::where('id',$id)->delete();
        return redirect()->route('allDeed',['id'=>$leeds->id])->with('message','File Deleted Successfully');
//        $file = Deed::where('id',$id)->get();
 //       echo $id;
    //    $path = public_path().'/Deed/';
//        if (file_exists(public_path('/Deed/'.$file->file)))
//        {
//            unlink(public_path('/Deed/'.$file->file));
//        }
      //  Storage::delete($path.$file->file);
//        $filesD = json_decode($file->file);
//        array_splice($filesD, $index, 1);
//        Deed::where('leedId', $id)->update($file);
        return redirect()->back()->with('message', 'File Removed successfully');
    }
    public  function downloadFile($id,$file){
//        $d = deed::find($file);
//        $filePath = public_path('Deed/'.$d->file);
//        $headers = ['Content-Type: application/pdf'];
//        $fileName = time().'.pdf';
//        return response()->download($filePath, $fileName, $headers);
//        if($v == 'pdf')
            $d = deed::find($file);
        $v = pathinfo($d->file, PATHINFO_EXTENSION);
//        echo $v;
//        die();
//        header("Content-Type: image/png");
        if($v == 'jpg'||$v == 'png'){
            $filePath = public_path('Deed/' . $d->file);
            $headers = ['Content-Type: image/png'];
            $fileName = time() . '.jpg';
            return response()->download($filePath, $fileName, $headers);
        }
        else{
            $filePath = public_path('Deed/' . $d->file);
            $headers = ['Content-Type: application/pdf'];
            $fileName = time() . '.pdf';
            return response()->download($filePath, $fileName, $headers);
        }
    }
}
