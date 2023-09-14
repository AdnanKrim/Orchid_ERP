@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="card">
                 <div class="card-header">
                    <span>Update Resignation</span>
                 </div>
                <div class="card-body">
                    <form action="{{route('updateResignation')}}" method="POST">
                    @csrf
                    <input class="form-control" type="hidden" name="id" id="id" value="{{$resignation->id}}">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="employee">Resignation Employee</label>
                        <div class="input-group search_select_box">
                            <select class="form-control" name="employee" id="employee" data-live-search="true">
                                <option value="">Choose an Employee</option>
                                @foreach ($users as $user)
                                <option @if($user->id === $userName->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="ndate">Notice Date</label>
                        <input class="form-control" type="date" name="ndate" id="ndate" value="{{$resignation->NoticeDate}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="rdate">Resignation Date</label>
                        <input class="form-control" type="date" name="rdate" id="rdate" value="{{$resignation->ResignationDate}}">
                    </div>
                </div>
            </div>
                    <div class="col-md-6">
                        <label for="description">Resignation Reason</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$resignation->Description}}</textarea>
                    </div>
            </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"></label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-success" id="submit" value="Update"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection
