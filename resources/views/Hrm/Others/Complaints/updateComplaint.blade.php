@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="card">
                 <div class="card-header">
                    <span>Update Complaints</span>
                 </div>
                <div class="card-body">
                    <form action="{{route('updateComplaint')}}" method="POST">
                    @csrf
                    <input class="form-control" type="hidden" name="id" id="id" value="{{$complaint->id}}">
                    <div class="form-group row">
                        <div class="col-md-6">
                        <label for="employee">Complaints From</label>
                        <div class="input-group search_select_box">
                            <select class="form-control" name="fromEmployee" id="employee" data-live-search="true">
                                <option value="">Choose an Employee</option>
                                @foreach ($users as $user)
                                <option @if($user->id === $fromUser->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-6">
                        <label for="department">Complaints Title</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Complaints Title" value="{{$complaint->Title}}">
                        </div>
                        <div class="col-md-6">
                        <label for="cdate">Complaints Date</label>
                        <input class="form-control" type="date" name="cdate" id="cdate" value="{{$complaint->ComplaintDate}}">
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                        <label for="tdate">Complaints Against</label>
                        <div class="input-group search_select_box">
                            <select class="form-control" name="toEmployee" id="toEmployee" data-live-search="true">
                                <option value="">Choose an Employee</option>
                                @foreach ($users as $user)
                                <option @if($user->id === $toUser ->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$complaint->Description}}</textarea>
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
