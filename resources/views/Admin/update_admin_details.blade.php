@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header text-center text-primary fs-3">Update Admin Profile</div>
                            <div class="card-body">
                                @if(Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show " id="errorMessage" role="alert">
                                        <strong>Error:</strong>
                                        {{ Session::get('error_message')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if(Session::has('Success_message'))
                                    <div class="alert alert-success alert-dismissible fade show " id="errorMessage" role="alert">
                                        <strong>Success:</strong>
                                        {{ Session::get('Success_message')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form action="{{ route('updateAdminDetails1') }}" method="POST" enctype="multipart/form-data"
                                >
                                    @csrf
                                    <div class="form-group row">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"> Name </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="name" value="{{ $user['name'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"> Phone </label>
                                            <div class="col-md-9">
                                                <input type="tel" class="form-control" name="phone" value="{{ $user['phone'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Photo </label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control" name="photo" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"></label>
                                        <div class="col-md-9">
                                            <input type="submit" class="btn btn-success" value="Update"/>
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
