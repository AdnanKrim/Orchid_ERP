@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="card">
                 <div class="card-header">
                    <span>Update Payroll Type</span>
                 </div>
                <div class="card-body">
                    <form action="{{route('updateTypePost')}}" method="POST">
                    @csrf
                    <input class="form-control" type="hidden" name="id" id="id" value="{{$type->id}}">
                    <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="name">Payroll Type Name</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Playroll Type Name" value="{{$type->payrollTypeName}}">
                                    </div>
                                    <div class="col-md-4">
                                    <div class="d-flex justify-content-start">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="Percentage" value="Percentage" onclick="PercentageChange()" @if(!empty($type->percentage)) checked @endif>
                                        <label for="Percentage">Percentage</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="Tk" value="Tk" onclick="Tkchange()" @if(!empty($type->tk)) checked @endif>
                                        <label for="Tk">Tk</label>
                                    </div>
                                    </div>
                                    <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter amount in" value="@if(!empty($type->percentage)) {{$type->percentage}} @endif @if(!empty($type->tk)) {{$type->tk}} @endif">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="generate">Payroll Generate</label>
                                    <div class="d-flex justify-content-start">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sign" id="plus" value="+" @if($type->payrollGenerate==="+") checked @endif>
                                        <label  for="plus">+</label>
                                    </div>&emsp;&emsp;
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sign" id="minus" value="-" @if($type->payrollGenerate==="-") checked @endif>
                                        <label  for="minus">-</label>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="update"/>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <script>
    function PercentageChange(){
        document.getElementById('amount').placeholder="Enter amount in %";
    }
    function Tkchange(){
        document.getElementById('amount').placeholder="Enter amount in Tk";
    }
  </script>
  @endsection
