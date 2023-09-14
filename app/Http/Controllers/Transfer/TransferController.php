<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Models\Account\Account;
use App\Models\Transfer\FundTransfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    private $file;
    private $fileName;
    private $directory;
    private $fileUrl;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addTransfer()
    {
        $accounts = Account::all();
        return view('Transfer.addTransfer',['accounts'=>$accounts]);
    }
    public function getFileUrl($request)
    {
        $this->file = $request->file('file');
        $this->fileName = $this->file->getClientOriginalName();
        $this->directory = 'transfer-files/';
        $this->file->move($this->directory, $this->fileName);
        $this->fileUrl = $this->directory.$this->fileName;
        return $this->fileUrl;
    }
    public function createTransfer(Request $request)
    {
        $transfer = new FundTransfer();
        $transfer->transferFromId = $request->transferFromId;
        $transfer->transferToId   = $request->transferToId;
        $transfer->amount       = $request->amount;
        $transfer->date         = $request->date;
        $transfer->ref          = $request->ref;
        if ($request->has('file')){
            $this->fileUrl      = $this->getFileUrl($request);
        }else{
            $this->fileUrl      = $transfer->file;
        }
        $transfer->file         = $this->fileUrl;
        $transfer->save();
        return redirect('all-transfer')->with('message','New Fund Transfer Info Created Successfully');
    }
    public function allTransfer()
    {
        $transfers = FundTransfer::all();
        return view('Transfer.allTransfer',['transfers'=>$transfers]);
    }
}
