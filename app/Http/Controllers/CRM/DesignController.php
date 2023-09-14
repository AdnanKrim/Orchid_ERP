<?php
namespace App\Http\Controllers\CRM;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\CRM\Leeds;
use App\Models\DesignWork;
use App\Models\DesignWorkFiles;
use App\Models\DesignWorkComments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    function designPage($id){
        $leeds = Leeds::find($id);
        $users = Auth::user()::all();
        $user = Auth::user();
        $des = DesignWork::all()->first();
        if(empty($des)){
            $design = "empty";
        }
        else{
            $design = $des;
        }
        $comment = DB::table('design_work_comments')
            ->join('users', 'design_work_comments.userId', '=', 'users.id') // For taking User Name
            ->join('design_works', 'design_work_comments.designWorkId', '=', 'design_works.id')
            ->where('design_works.leedId', $id)
            ->select('users.name','users.photo','design_work_comments.comment','design_work_comments.userId')
            ->get();
        $files = DesignWorkFiles::all();
        return view('CRM.DesignWork.designWork',['leed'=>$leeds,'users'=>$users,'design'=>$design,'comment'=>$comment,'files'=>$files]);
    }
    function designInfo($id){
        $leeds = Leeds::find($id);
        return view('CRM.DesignWork.updateWork',['leed'=>$leeds]);
    }
    function createDesignWork(Request $request,$id){
        $leeds = Leeds::find($id);
        $request->validate([
            'leedId' => 'required',
            'workTime' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'workProgress' => 'required',
            'assignTo' => 'required',
        ]);
        $design = new DesignWork;
        $design->leedId = $request->leedId;
        $design->workTime = $request->workTime;
        $design->startDate = $request->startDate;
        $design->endDate = $request->endDate;
        $design->workProgress = $request->workProgress;
        $design->assignTo = json_encode($request->assignTo);
        $design->save();
        return redirect()->route('designPage',['id'=>$leeds->id])->with('Success_Message','Design Work Inserted Successfully');
    }
    function updateDesignWork(Request $request,$id,$did){
        $leeds = Leeds::find($id);
        $design = DesignWork::find($did);
        $design->leedId = $request->leedId;
        $design->workTime = $request->workTime;
        $design->startDate = $request->startDate;
        $design->endDate = $request->endDate;
        $design->workProgress = $request->workProgress;
        $design->assignTo = json_encode($request->assignTo);
        $design->save();
        return redirect()->route('designPage',['id'=>$leeds->id])->with('Success_Message','New Design Work Updated Successfully');
    }
    function insertComment(Request $request,$id){
        $leeds = Leeds::find($id);
        $comment = new DesignWorkComments;
        $comment->comment = $request->comment;
        $comment->designWorkId = $request->designWorkId;
        $comment->userId = $request->userId;
        $comment->save();
        return redirect()->route('designPage',['id'=>$leeds->id])->with('Success_Message','Design Work Comment Inserted Successfully');
    }
    function insertFile(Request $request,$id){
        $leeds = Leeds::find($id);
        $file =new DesignWorkFiles;
        $file->designWorkId = $request->designWorkId;
        $file->userId = $request->userId;
        $fileName = $request->file('file');
        $imageName = $fileName->getClientOriginalName();
        $directory = 'Design-Work-Files/';
        $fileName->move($directory, $imageName);
        $imageUrl = $directory.$imageName;
        $file->file = $imageUrl;
        $file->fileName = $request->fileName;
        $file->save();
        return redirect()->route('designPage',['id'=>$leeds->id])->with('Success_Message','Design File Inserted Successfully');
    }
    public function downloadfile($id,$file)
    {
        $d = DesignWorkFiles::find($file);
        $v = pathinfo($d->file, PATHINFO_EXTENSION);
        $filePath = public_path($d->file);
        $headers = ['Content-Type: application/pdf'];
        $fileName = time().'.'.$v;
        return response()->download($filePath, $fileName, $headers);
    }
}
