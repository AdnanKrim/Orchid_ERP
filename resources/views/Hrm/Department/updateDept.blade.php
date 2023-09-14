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
                            <span>Edit Department</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('updateDept')}}" method="POST">
                            <input type="hidden" class="form-control" name="id" value="{{$department->id}}"/>
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{$department->departmentName}}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Department Head</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="head">
                                        <option value="">Select a department head</option>
                                        @foreach ($heads as $head)
                                        <option @if($head->id === $deptHead->id) selected @endif value="{{$head->id}}">{{$head->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Branch</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="branch">
                                        <option value="">Select a branch</option>
                                        @foreach ($branches as $branch)
                                        <option @if($branch->id === $branchName->id) selected @endif value="{{$branch->id}}">{{$branch->branchName}}</option>
                                            @endforeach
                                        </select>
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
