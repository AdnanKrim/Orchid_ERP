@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Add Withdraw</div>
                            <div class="card-body">
                                <h4 class="text-success">{{ Session::get('message') }}</h4>
                                <form action="{{route('update.withdraw',['id'=>$withdraw->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">date<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="date" required class="form-control" value="{{$withdraw->date}}" name="date"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Bank Name<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <select required class="form-control" name="bankId">
                                                @foreach($banks as $bank)
                                                    <option {{$bank->id==$withdraw->bankId?'selected':''}} value="{{$bank->id}}">{{$bank->name.'-'.$bank->accNo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">checkNo<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="number" required class="form-control" value="{{$withdraw->checkNo}}" name="checkNo"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">CheckType<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="text" required class="form-control" value="{{$withdraw->checkType}}" name="checkType"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Amount<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="number" required class="form-control" value="{{$withdraw->amount}}" name="amount"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Charge</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" value="{{$withdraw->charge}}" name="charge"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">File(if any)</label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="file" accept="*"/>
                                            <img src="{{asset($withdraw->file)}}" alt="{{$withdraw->file}}" style="height: 65px; width: 65px;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Note</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{$withdraw->note}}" name="note"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"></label>
                                        <div class="col-md-9">
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
