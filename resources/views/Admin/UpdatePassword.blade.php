@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header text-center text-primary fs-3">Update Admin Password</div>
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
                                <form action="{{ route('updateAdminPassword1') }}" method="POST"
                                   >
                                    @csrf
                                    <div class="form-group row">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Admin Email</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="companyName" value="{{ $user['email'] }}">
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" >Current Password </label>
                                            <div class="col-md-9">
                                                <input type="password"  class="form-control" name="old_password" id="old_password" placeholder="Enter Current Password" required/>
                                            </div>
                                            <span id="check_password" class="check"></span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">New Password </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="new_password"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Confirm Password </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="confirm_password"/>
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
