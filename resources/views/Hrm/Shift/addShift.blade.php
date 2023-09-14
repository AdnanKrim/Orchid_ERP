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
                            <span>Create Shift</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('addShiftPost')}}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="shiftName">Shift Name<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="shiftName" id="shiftName" placeholder="Please Enter shift Name">
                                        <span class="text-danger">@error('shiftName'){{ $message }}@enderror</span>
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
