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
                            <span>Update Leave Purpose</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('LeavePurposeUpdate')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" type="hidden" name="id" id="id" value="{{$leavePurpose->id}}">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="purpose">Leave Purpose</label>
                                        <input class="form-control" type="text" name="purpose" id="purpose" placeholder="Leave purpose" value="{{$leavePurpose->leavePurpose}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="note">Note</label>
                                        <textarea class="form-control" name="note" id="note">{{$leavePurpose->note}}</textarea>
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
