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
                            <span>Update Default Off Day</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('updateDefaultOffDayPost')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$day->id}}">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="dayName">Day Name<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="dayName" id="dayName" data-live-search="true">
                                                <option value="">Select an Day</option>
                                                <option @if($day->dayName === "Saturday") selected @endif value="Saturday">Saturday</option>
                                                <option @if($day->dayName === "Sunday") selected @endif value="Sunday">Sunday</option>
                                                <option @if($day->dayName === "Monday") selected @endif value="Monday">Monday</option>
                                                <option @if($day->dayName === "Tuesday") selected @endif value="Tuesday">Tuesday</option>
                                                <option @if($day->dayName === "Wednesday") selected @endif value="Wednesday">Wednesday</option>
                                                <option @if($day->dayName === "Thursday") selected @endif value="Thursday">Thursday</option>
                                                <option @if($day->dayName === "Friday") selected @endif value="Friday">Friday</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('day'){{ $message }}@enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="offDay">Default Off day</label>
                                    <div class="col-md-8">
                                            <select class="form-control" name="offDay" id="offDay" data-live-search="true">
                                                <option @if($day->offDay === 1) selected @endif value="1">Yes</option>
                                                <option @if($day->offDay === 0) selected @endif value="0">No</option>
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
