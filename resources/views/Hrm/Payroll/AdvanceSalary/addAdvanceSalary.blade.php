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
                            <span>Create Advance Salary</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('AdvanceSalaryPost')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="employee">Employee Name<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="employee" id="employee" data-live-search="true">
                                                <option value="">Select an Employee</option>
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('employee'){{ $message }}@enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="amount">Amount<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="number" name="amount" id="amount" placeholder="Please Enter salary amount">
                                        <span class="text-danger">@error('amount'){{ $message }}@enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="salMonth">Salary Month</label>
                                    <div class="col-md-8">
                                        @php
                                        $currentMonth = date('Y-m');
                                        @endphp

                                        <input class="form-control" type="month" name="salMonth" id="salMonth" min={{$currentMonth}} value={{$currentMonth}}>
                                        <span class="text-danger">@error('salMonth'){{ $message }}@enderror</span>
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
