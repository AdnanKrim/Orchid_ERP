<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Account\Account;
use App\Models\CRM\Leeds;
use App\Models\Expense\ExpCategory;
use App\Models\Expense\Expense;
use App\Models\Settings\CompanyInfo;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private $file;
    private $fileName;
    private $directory;
    private $fileUrl;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addExpense()
    {
        $expcategories = ExpCategory::all();
        $branches = CompanyInfo::all();
        $leeds = Leeds::where('isSuccess',1)->get();
        $users = User::all();
        $accounts = Account::all();
        return view('Expense.Expense.addExpense',[
            'expcategories'=>$expcategories,
            'branches'=>$branches,
            'leeds'=>$leeds,
            'users'=>$users,
            'accounts'=>$accounts,
        ]);
    }
    public function getFileUrl($request)
    {
        $this->file = $request->file('file');
        $this->fileName = $this->file->getClientOriginalName();
        $this->directory = 'expense-images/';
        $this->file->move($this->directory, $this->fileName);
        $this->fileUrl = $this->directory.$this->fileName;
        return $this->fileUrl;
    }
    public function createExpense(Request $request)
    {
        $exp = new Expense();
        $exp->date = $request->date;
        $exp->expCategoryId = $request->expCategoryId;
        $exp->branchId = $request->branchId;
        $exp->for = $request->for;
        $exp->expAmount = $request->expAmount;
        if ($request->has('file')){
            $this->fileUrl = $this->getFileUrl($request);
        }else{
            $this->fileUrl = $exp->file;
        }
        $exp->file = $this->fileUrl;
        $exp->expNote = $request->expNote;
        $exp->clientId = $request->clientId;
        $exp->userId = $request->userId;
        $exp->paymentAmount = $request->paymentAmount;
        if ($exp->paymentAmount == $exp->expAmount){
            $status = 'Paid';
        }elseif ($request->paymentAmount >> 0){
            $status = 'Partial';
        }else{
            $status = 'Unpaid';
        }
        $exp->paymentStatus = $status;
        $exp->accountId = $request->accountId;
        $exp->paymentNote = $request->paymentNote;
        $exp->due = ($request->expAmount - $request->paymentAmount);
        $exp->save();
        return redirect('all-exp')->with('message','New Expense Created Successfully!');
    }
    public function allExpense()
    {
        $expenses = Expense::all();
        return view('Expense.Expense.allExpense',['expenses'=>$expenses]);
    }
    public function editExpense($id)
    {
        $expcategories = ExpCategory::all();
        $branches = CompanyInfo::all();
        $leeds = Leeds::all();
        $users = User::all();
        $accounts = Account::all();
        $exp = Expense::where('id',$id)->first();
        return view('Expense.Expense.editExpense',[
            'expcategories'=>$expcategories,
            'branches'=>$branches,
            'leeds'=>$leeds,
            'users'=>$users,
            'accounts'=>$accounts,
            'exp'=>$exp,
        ]);
    }
    public function updateExpense(Request $request, $id)
    {
        $exp = Expense::where('id',$id)->first();
        $exp->date = $request->date;
        $exp->expCategoryId = $request->expCategoryId;
        $exp->branchId = $request->branchId;
        $exp->for = $request->for;
        $exp->expAmount = $request->expAmount;
        if ($request->has('file')){
            if (file_exists($exp->file)){
                unlink($exp->file);
            }
            $this->fileUrl = $this->getFileUrl($request);
        }else{
            $this->fileUrl = $exp->file;
        }
        $exp->file = $this->fileUrl;
        $exp->expNote = $request->expNote;
        $exp->clientId = $request->clientId;
        $exp->userId = $request->userId;
        $exp->paymentAmount = $request->paymentAmount;
        if ($exp->paymentAmount == $exp->expAmount){
            $status = 'Paid';
        }elseif ($request->paymentAmount >> 0){
            $status = 'Partial';
        }else{
            $status = 'Pending';
        }
        $exp->paymentStatus = $status;
        $exp->accountId = $request->accountId;
        $exp->paymentNote = $request->paymentNote;
        $exp->due = ($request->expAmount - $request->paymentAmount);
        $exp->save();
        return redirect('all-exp')->with('message','Expense Updated Successfully!');
    }
    public function deleteExpense($id)
    {
        $exp = Expense::where('id',$id)->first();
        if (file_exists($exp->file)){
            unlink($exp->file);
        }
        $exp->delete();
        return redirect('all-exp')->with('message','Expense Deleted Successfully!');
    }
}
