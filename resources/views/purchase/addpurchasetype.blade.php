@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">

                            <div class="card-header" style="text-align: center"><h5>Add Purchase Type </h5></div>
                            <div class="card-body">
                                <form action="addPurchaseType" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Purchase Type<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="purchaseType" />
                                            <span style="color:red;">@error('purchaseType'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Purchase Code</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="code" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label"></label>
                                        <div class="col-md-7">
                                            <input type="submit" class="btn btn-success" value="Save" />
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
