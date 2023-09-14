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
                            <span>Create Default Of Day</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('addDefaultOffDayPost')}}" method="POST">
                                @csrf


                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="dayName">Day Name<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="dayName" id="dayName" data-live-search="true">
                                                <option value="">Select an Day</option>
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('day'){{ $message }}@enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="offDay">Default Off day</label>
                                    <div class="col-md-8">
                                            <select class="form-control" name="offDay" id="offDay" data-live-search="true">
                                                <option value="1">Yes</option>
                                                <option selected value="0">No</option>
                                            </select>
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
  <!-- /.content-wrapper -->
  @endsection
