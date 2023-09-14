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
                            <span>Add New Holiday</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('addHolidayPost')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="name">Holiday Name</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Holiday Name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="startDate">Start Date</label>
                                        <input class="form-control" type="date" name="startDate" id="startDate" onchange="countDate()">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endDate">End Date</label>
                                        <input class="form-control" type="date" name="endDate" id="endDate" onchange="countDate()">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="totalDays">Total Days</label>
                                        <input class="form-control" type="text" name="totalDays" id="totalDays" value="0" readonly>
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
