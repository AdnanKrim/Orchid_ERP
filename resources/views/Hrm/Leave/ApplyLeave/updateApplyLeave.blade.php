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
                            <span>Update Apply Leave</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('ApplyLeaveUpdate')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" type="hidden" name="id" id="id" value="{{$applyLeave->id}}">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="applyDate">Date of Application</label>
                                        <input class="form-control" type="date" name="applyDate" id="applyDate" value="{{$applyLeave->dateOfApplication}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="leaveDate">Year and Month</label>
                                        <input class="form-control" type="date" name="leaveDate" id="leaveDate" value="{{$applyLeave->leaveDate}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="employee">Employee</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="employee" id="employee" data-live-search="true">
                                                <option value="">Choose an Employee</option>
                                                @foreach ($users as $user)
                                                <option @if($user->id === $userName->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="leaveType">Leave Type</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="leaveType" id="leaveType" data-live-search="true">
                                                <option value="">Choose an Leave Type</option>
                                                @foreach ($leaveTypes as $leaveType)
                                                <option @if($leaveType->id === $typesName->id) selected @endif value="{{$leaveType->id}}">{{$leaveType->leaveType}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="leavePurpose">Leave Purpose</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="leavePurpose" id="leavePurpose" data-live-search="true">
                                                <option value="">Choose an Leave Purpose</option>
                                                @foreach ($leavePurposes as $leavePurpose)
                                                <option @if($leavePurpose->id === $purposeName->id) selected @endif value="{{$leavePurpose->id}}">{{$leavePurpose->leavePurpose}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="startDate">Start Date</label>
                                        <input class="form-control" type="date" name="startDate" id="startDate" value="{{$applyLeave->startDate}}" onchange="countDate()">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="endDate">End Date</label>
                                        <input class="form-control" type="date" name="endDate" id="endDate" value="{{$applyLeave->endDate}}" onchange="countDate()">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="totalDays">Total Days</label>
                                        <input class="form-control" type="text" name="totalDays" id="totalDays" value="{{$applyLeave->totalDays}}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="details">Details</label>
                                        <textarea class="form-control" name="details" id="details" placeholder="Details">{{$applyLeave->details}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <label for="file">Attached File</label>
                                    <input class="form-control" type="file" name="file" id="file">
                                    <a href="../leave_file/{{$applyLeave->file}}" id="documentFile" download>{{$applyLeave->file}}</a>
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
  <script>
    function countDate() {
        var d1 = document.getElementById('startDate').value;
        var d2 = document.getElementById('endDate').value;
        if(d1 != "" && d2 != ""){
        const start = new Date(d1);
        const end = new Date(d2);
        const totaltime = Math.abs(end - start);
        const totalday = Math.ceil(totaltime / (1000 * 60 * 60 * 24));
        console.log(totalday);
        document.getElementById('totalDays').value = totalday;
        }
        else{
            document.getElementById('totalDays').value = 0;
        }
    }
  </script>
  <!-- /.content-wrapper -->
  @endsection
