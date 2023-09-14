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
                                <form action="{{route('new.withdraw')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">date<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="date" required class="form-control" name="date"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Bank Name<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <select required class="form-control" name="bankId">
                                                <option selected disabled>--select--</option>
                                                @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->name.'-'.$bank->accNo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">checkNo<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="number" required class="form-control" name="checkNo"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">CheckType<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="text" required class="form-control" name="checkType"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Amount<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="number" required class="form-control" name="amount"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Charge</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="charge"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">File(if any)</label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="file" accept="*"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Note</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="note"/>
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
