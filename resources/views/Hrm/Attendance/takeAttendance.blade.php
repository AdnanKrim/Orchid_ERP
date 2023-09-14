@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span>Take Attendance</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('AttendancePost')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Date</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="date" value="<?= date('Y-m-d', time()); ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">User</label>
                                    <div class="col-md-8">
                                    <div class="input-group search_select_box">
                                        <select class="form-control" name="employee" id="employee" data-live-search="true">
                                            <option value="">Select an Employee</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Attendance Status</label>
                                    <div class="col-md-8">
                                    <div class="input-group search_select_box">
                                        <select class="form-control" name="status" id="status" data-live-search="true" onchange="setTime(this.value)">
                                            <option value="1">Present</option>
                                            <option selected value="0">Absent</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            <div style="display: none" id="setTime">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="inTime">In Time</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="time" name="inTime" id="inTime">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="outTime">Out Time</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="time" name="outTime" id="outTime">
                                    </div>
                                </div>
                            </div>


                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="Add"/>
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
    function setTime(value){
        if(value === "1"){
            document.getElementById('setTime').style.display = 'block';

        }
        else if(value === "0"){
            document.getElementById('setTime').style.display = 'none';
            document.getElementById('inTime').value = ''
            document.getElementById('outTime').value = ''
        }
    }
</script>
  <!-- /.content-wrapper -->
  @endsection
