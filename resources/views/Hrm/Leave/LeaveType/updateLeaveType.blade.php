@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span>Update Leave Type</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('LeaveTypeUpdate')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" type="hidden" name="id" id="id" value="{{$leaveTypes->id}}">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="type">Leave Type</label>
                                        <input class="form-control" type="text" name="type" id="type" placeholder="Leave Type" value="{{$leaveTypes->leaveType}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="numberOfleave">Number of Leaves</label>
                                        <input class="form-control" type="number" name="numberOfleave" id="numberOfleave" value="{{$leaveTypes->NumberOfLeave}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="maxLeave">Max number of leave per month</label>
                                        <input class="form-control" type="number" name="maxLeave" id="maxLeave" value="{{$leaveTypes->MaximumLeave}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="totalDays">Leave Status</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="status" id="status" data-live-search="true">
                                                <option value="">Choose a Status</option>
                                                <option @if($leaveTypes->Status === 0) selected @endif value="0">Inactive</option>
                                                <option @if($leaveTypes->Status === 1) selected @endif value="1">Active</option>
                                            </select>
                                        </div>
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
