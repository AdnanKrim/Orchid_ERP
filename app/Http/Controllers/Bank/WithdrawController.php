<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank\Bank;
use App\Models\Bank\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    private $fileUrl;
    private $file;
    private $fileName;
    private $directory;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allWithdraw()
    {
        $withdraws = Withdraw::all();
        return view('Bank.Withdraw.allWithdraw',['withdraws'=>$withdraws]);
    }
    public function addWithdraw()
    {
        $banks = Bank::all();
        return view('Bank.Withdraw.addWithdraw',['banks'=>$banks]);
    }
    public function getFileUrl($request)
    {
        $this->file = $request->file;
        $this->fileName = $this->file->getClientOriginalName();
        $this->directory = 'withdraw-files/';
        $this->file->move($this->directory, $this->fileName);
        $this->fileUrl = $this->directory.$this->fileName;
        return $this->fileUrl;
    }
    public function createWithdraw(Request $request)
    {
        $withdraw = new Withdraw();
        if ($request->has('file')){
            $this->fileUrl = $this->getFileUrl($request);
        };
        $withdraw->date = $request->date;
        $withdraw->bankId = $request->bankId;
        $withdraw->checkNo = $request->checkNo;
        $withdraw->checkType = $request->checkType;
        $withdraw->amount = $request->amount;
        $withdraw->charge = $request->charge;
        $withdraw->file = $this->fileUrl;
        $withdraw->note = $request->note;
        $withdraw->save();
        return redirect('all-withdraw')->with('message','New Withdraw Created Successfully!');
    }
    public function editWithdraw($id)
    {
        $banks = Bank::all();
        $withdraw = Withdraw::where('id',$id)->first();
        return view('Bank.Withdraw.editWithdraw',['banks'=>$banks,'withdraw'=>$withdraw]);
    }
    public function updateWithdraw(Request $request, $id)
    {
        $withdraw = Withdraw::where('id',$id)->first();
        if ($request->has('file')){
            unlink($withdraw->file);
            $this->fileUrl = $this->getFileUrl($request);
        }else{
            $this->fileUrl = $withdraw->file;
        }
        $withdraw->date = $request->date;
        $withdraw->bankId = $request->bankId;
        $withdraw->checkNo = $request->checkNo;
        $withdraw->checkType = $request->checkType;
        $withdraw->amount = $request->amount;
        $withdraw->charge = $request->charge;
        $withdraw->file = $this->fileUrl;
        $withdraw->note = $request->note;
        $withdraw->save();
        return redirect('all-withdraw')->with('message','Withdraw Updated Successfully!');
    }
    public function deleteWithdraw(Request $request, $id)
    {
        $withdraw = Withdraw::where('id',$id)->first();
        unlink($withdraw->file);
        $withdraw->delete();
        return redirect('all-withdraw')->with('message','Withdraw Deleted Successfully!');
    }
}
