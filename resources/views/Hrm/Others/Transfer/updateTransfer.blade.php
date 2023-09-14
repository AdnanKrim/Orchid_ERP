@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="card">
                 <div class="card-header">
                    <span>Update Transfer</span>
                 </div>
                <div class="card-body">
                    <form action="{{route('UpdateTransfer')}}" method="POST">
                    @csrf
                    <input class="form-control" type="hidden" name="id" id="id" value="{{$transfer->id}}">
                    <div class="form-group row">
                        <div class="col-md-6">
                        <label for="employee">Employee to Transfer</label>
                        <div class="input-group search_select_box">
                            <select class="form-control" name="employee" id="employee" data-live-search="true">
                                <option value="">Choose an Employee</option>
                                @foreach ($users as $user)
                                <option @if($user->id === $userName->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                        <label for="tdate">Transfer Date</label>
                        <input class="form-control" type="date" name="tdate" id="tdate" value="{{$transfer->TransferDate}}">
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-6">
                        <label for="department">Transfer To (Deparment)</label>
                        <div class="input-group search_select_box">
                            <select class="form-control" name="department" id="department" data-live-search="true">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                <option @if($department->id === $departmentName->id) selected @endif value="{{$department->id}}">{{$department->departmentName}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <label for="location">Transfer To (Location)</label>
                        <div class="input-group search_select_box">
                            <select class="form-control" name="location" id="location" data-live-search="true">
                                <option value="">Select Location</option>
                                @foreach ($branches as $branch)
                                <option @if($branch->id === $branchName->id) selected @endif value="{{$branch->id}}">{{$branch->companyName}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$transfer->Description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"></label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-success" id="submit" value="Update"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection
