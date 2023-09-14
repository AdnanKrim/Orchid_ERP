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
                            <span>Edit Designation</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('updateDesignation')}}" method="POST">
                            <input type="hidden" class="form-control" name="id" value="{{$designation->id}}"/>
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{$designation->designationName}}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Department</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="dept">
                                        <option value="">Select a department</option>
                                        @foreach ($departments as $department)
                                        <option @if($department->id === $deptName->id) selected @endif value="{{$department->id}}">{{$department->departmentName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Attendance Type</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="atype">
                                        <option value="">Select a Type</option>
                                        <option @if($designation->attendanceType==="Monthly") selected @endif value="Monthly">Monthly</option>
                                        <option  @if($designation->attendanceType==="Daily") selected @endif value="Daily">Daily</option>
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
