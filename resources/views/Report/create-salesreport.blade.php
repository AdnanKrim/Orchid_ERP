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

                            <div class="card-header">Create Report </div>
                            <div class="card-body">
                                <form action="store-sales-report" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Entry Date</label>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control" name="date" />
                                            <span style="color:red;">
                                                @error('date')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Invoce No</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="InvoiceNo" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Client Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="client_name" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Project Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="project_name" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Business Branch</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="business_branch" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Amount</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" name="amount" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Add" />
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
