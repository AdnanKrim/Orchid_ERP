<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank\Bank;
use App\Models\Bank\Deposit;
use Illuminate\Http\Request;
use function League\Flysystem\Local\move;

class DepositController extends Controller
{
    private $fileUrl;
    private $file;
    private $fileName;
    private $directory;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addDeposit()
    {
        $banks = Bank::all();
        return view('Bank.Deposit.addDeposit',['banks'=>$banks]);
    }
    public function getFileUrl($request)
    {
        $this->file = $request->file;
        $this->fileName = $this->file->getClientOriginalName();
        $this->directory = 'deposit-files/';
        $this->file->move($this->directory, $this->fileName);
        $this->fileUrl = $this->directory.$this->fileName;
        return $this->fileUrl;
    }
    public function createDeposit(Request $request)
    {
        $deposit = new Deposit();
        if ($request->has('file')){
            $this->fileUrl = $this->getFileUrl($request);
        };
        $deposit->date = $request->date;
        $deposit->bankId = $request->bankId;
        $deposit->amount = $request->amount;
        $deposit->charge = $request->charge;
        $deposit->file = $this->fileUrl;
        $deposit->note = $request->note;
        $deposit->save();
        return redirect('all-deposit')->with('message','New Deposit Created Successfully!');
    }
    public function allDeposit()
    {
        $deposits = Deposit::all();
        return view('Bank.Deposit.allDeposit',['deposits'=>$deposits]);
    }
    public function editDeposit($id)
    {
        $banks = Bank::all();
        $deposit = Deposit::where('id',$id)->first();
        return view('Bank.Deposit.editDeposit',['deposit'=>$deposit,'banks'=>$banks]);
    }
    public function updateDeposit(Request $request, $id)
    {
        $deposit = Deposit::where('id',$id)->first();
        if ($request->has('file')){
            unlink($deposit->file);
            $this->fileUrl = $this->getFileUrl($request);
        }else{
            $this->fileUrl = $this->getFileUrl($request);
        }
        $deposit->date = $request->date;
        $deposit->bankId = $request->bankId;
        $deposit->amount = $request->amount;
        $deposit->charge = $request->charge;
        $deposit->file = $this->fileUrl;
        $deposit->note = $request->note;
        $deposit->save();
        return redirect('all-deposit')->with('message','Deposit Updated Successfully!');
    }
    public function deleteDeposit($id)
    {
        $deposit = Deposit::where('id',$id)->first();
        unlink($deposit->file);
        $deposit->delete();
        return redirect('all-deposit')->with('message','Deposit Deleted Successfully!');
    }
}
