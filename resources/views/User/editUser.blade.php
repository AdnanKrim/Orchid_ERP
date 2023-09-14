@extends('master.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span>Edit User</span>

                        </div>
                        <div class="card-body">

                            <form action="{{route('userEditSubmit')}}" method="POST">
                            <input type="hidden" class="form-control" name="id" value="{{$user->id}}"/>
                                @csrf
                                @if (\Session::has('failed'))
                         <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {!! \Session::get('failed') !!}
                        </div>
                        @endif

                        @if (\Session::has('success'))
                         <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {!! \Session::get('success') !!}
                        </div>
                        @endif
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">User Role</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="userRole">
                                        <option value="">Select a Role</option>
                                        <option value="{{$roleName->role}}" selected>{{$roleName->role}}</option>
                                        @foreach ($role as $roles)
                                        <option value="{{$roles->role}}">{{$roles->role}}</option>
                                        @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email" value="{{$user->email}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Phone</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="phone" value="{{$user->phone}}"/>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
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
