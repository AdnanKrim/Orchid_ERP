@extends('master.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="app">
<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">Add Expense Form</div>
                        <div class="card-body">
                            <form action="{{route('new.exp')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">date<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <input type="date" required class="form-control" name="date"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Expense Category<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <select type="number" required class="form-control" name="expCategoryId">
                                            <option selected disabled>--select--</option>
                                            @foreach($expcategories as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Business Branch<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <select type="number" required class="form-control" name="branchId">
                                            <option selected disabled>--select--</option>
                                            @foreach($branches as $value)
                                                <option value="{{$value->id}}">{{$value->companyName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Expense For<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <input type="text" required class="form-control" name="for"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Expense Amount<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <input type="number" required class="form-control" name="expAmount"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Attach Document(if any)</label>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" name="file" accept="*"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Expense Note</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="expNote"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Under Client<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <select type="number" required class="form-control" name="clientId">
                                            <option selected disabled>--select--</option>
                                            @foreach($leeds as $value)
                                                <option value="{{$value->id}}">{{$value->clientName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Expense By<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <select type="number" required class="form-control" name="userId">
                                            <option selected disabled>--select--</option>
                                            @foreach($users as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
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
                                        <input type="number" required class="form-control" name="paymentAmount"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Payment Method<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <select type="number" required class="form-control" name="accountId">
                                            <option selected disabled>--select--</option>
                                            @foreach($accounts as $value)
                                                <option value="{{$value->id}}">{{$value->accName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Payment Note</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="paymentNote"/>
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

