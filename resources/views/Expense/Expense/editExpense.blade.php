@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Edit Expense Form</div>
                            <div class="card-body">
                                <form action="{{route('update.exp',['id'=>$exp->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">date<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <input type="date" required class="form-control" value="{{$exp->date}}" name="date"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Expense Category<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <select type="number" required class="form-control" name="expCategoryId">
                                                @foreach($expcategories as $value)
                                                    <option {{$exp->expCategoryId==$value->id?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Business Branch<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <select type="number" required class="form-control" name="branchId">
                                                @foreach($branches as $value)
                                                    <option {{$exp->branchId==$value->id?'selected':''}} value="{{$value->id}}">{{$value->companyName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Expense For<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <input type="text" required class="form-control" value="{{$exp->for}}" name="for"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Expense Amount<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <input type="number" required class="form-control" value="{{$exp->expAmount}}" name="expAmount"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Attach Document(if any)</label>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control" name="file" accept="*"/>
                                            <img src="{{asset($exp->file)}}" alt="{{$exp->file}}" style="height: 65px; width: 65px;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Expense Note</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" value="{{$exp->expNote}}" name="expNote"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Under Client<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <select type="number" required class="form-control" name="clientId">
                                                @foreach($leeds as $value)
                                                    <option {{$exp->clientId==$value->id?'selected':''}} value="{{$value->id}}">{{$value->clientName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Expense By<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <select type="number" required class="form-control" name="userId">
                                                @foreach($users as $value)
                                                    <option {{$exp->userId==$value->id?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label"></label>
                                        <div class="col-md-7">
                                            <label><u>Payment</u></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Payment Amount<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <input type="number" required class="form-control" value="{{$exp->paymentAmount}}" name="paymentAmount"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Payment Method<span class="text-danger"> *</span></label>
                                        <div class="col-md-8">
                                            <select type="number" required class="form-control" name="accountId">
                                                @foreach($accounts as $value)
                                                    <option {{$exp->accountId==$value->id?'selected':''}} value="{{$value->id}}">{{$value->accName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Payment Note</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" value="{{$exp->paymentNote}}" name="paymentNote"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Save"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection

