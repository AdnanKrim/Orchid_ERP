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
                            <span>Update Loan Installment</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('LoanInstallmentUpdate')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" type="hidden" name="id" id="id" value="{{$loanInstallment->id}}">
                                <div class="form-group row">
                                <div class="col-md-6">
                                        <label for="date">Date</label>
                                        <input class="form-control" type="date" name="date" id="date" value="{{$loanInstallment->Date}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="employee">Employee Name</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="employee" id="employee" data-live-search="true">
                                                <option value="">Choose an Employee</option>
                                                @foreach($users as $user)
                                                <option @if($user->id === $userName->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="installmentWithInterest">Installment Amount With Interest</label>
                                        <input class="form-control" type="number" step="0.1" name="installmentWithInterest" id="installmentWithInterest" value="{{$loanInstallment->InstallmentWithInterest}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ReceivedBy">ReceivedBy</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="ReceivedBy" id="ReceivedBy" data-live-search="true">
                                                <option value="">Select Employee</option>
                                                @foreach($users as $user)
                                                <option @if($user->id === $receivedByName->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
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

  @endsection
