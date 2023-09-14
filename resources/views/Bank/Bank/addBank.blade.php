@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Add Bank</div>
                            <div class="card-body">
                                <h4 class="text-success">{{ Session::get('message') }}</h4>
                                <form action="{{route('new.bank')}}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Bank Name<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="text" required class="form-control" name="name"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Acc Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="accName"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Acc No<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="text" required class="form-control" name="accNo"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Branch<i class="text-danger">*</i></label>
                                        <div class="col-md-9">
                                            <input type="text" required class="form-control" name="branch"/>
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
