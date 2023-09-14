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
                            <span>Update Grant Loan</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('GrantLoanUpdate')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" type="hidden" name="id" id="id" value="{{$grantLoan->id}}">
                                <div class="form-group row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <label for="loanAmount">Loan Amount</label>
                                        <input class="form-control" type="number" step="0.1" name="loanAmount" id="loanAmount" value="{{$grantLoan->LoanAmount}}" onkeyup="calculation()">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="loanDetails">Loan Details</label>
                                        <textarea class="form-control" name="loanDetails" id="loanDetails" cols="0" rows="1">{{$grantLoan->LoanDetails}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="interestPercentage">Interest Percentage (%)</label>
                                        <input class="form-control" type="number" step="0.1" name="interestPercentage" id="interestPercentage" value="{{$grantLoan->InterestPercentage}}" onkeyup="calculation()">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="installmentPeriod">Installment Period</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="installmentPeriod" id="installmentPeriod" data-live-search="true">
                                                <option value="">Choose an installment period</option>
                                                <option @if($grantLoan->InstallmentPeriod="1 month") selected @endif value="1 month">1 month</option>
                                                <option @if($grantLoan->InstallmentPeriod="3 month") selected @endif value="3 month">3 month</option>
                                                <option @if($grantLoan->InstallmentPeriod="6 month") selected @endif value="6 month">6 month</option>
                                                <option @if($grantLoan->InstallmentPeriod="9 month") selected @endif value="9 month">9 month</option>
                                                <option @if($grantLoan->InstallmentPeriod="12 month") selected @endif value="12 month">12 month</option>
                                                <option @if($grantLoan->InstallmentPeriod="18 month") selected @endif value="18 month">18 month</option>
                                                <option @if($grantLoan->InstallmentPeriod="24 month") selected @endif value="24 month">24 month</option>
                                                <option @if($grantLoan->InstallmentPeriod="36 month") selected @endif value="36 month">36 month</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="totalInterest">Total Interest Amount</label>
                                        <input class="form-control" type="number" name="totalInterest" id="totalInterest" value="{{$grantLoan->TotalInterestAmount}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="totalRepayment">Total Repayment</label>
                                        <input class="form-control" type="number" name="totalRepayment" id="totalRepayment" value="{{$grantLoan->TotalRepayment}}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="repaymentFrom">Repayment From</label>
                                        <input class="form-control" type="date" name="repaymentFrom" id="repaymentFrom" value="{{$grantLoan->RepaymentFrom}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="permittedBy">Permitted By</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="permittedBy" id="permittedBy" data-live-search="true">
                                                <option value="">Select Employee</option>
                                                @foreach($users as $user)
                                                <option @if($user->id === $permittedByName->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
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
  <!-- /.content-wrapper -->
    <script>
        function calculation() {
            let loanAmount = parseInt(document.getElementById('loanAmount').value);
            let interestPercentage = parseFloat(document.getElementById('interestPercentage').value);
            if(document.getElementById('loanAmount').value === ""){
                loanAmount = 0;
            }
            if(document.getElementById('interestPercentage').value === ""){
                interestPercentage = 0;
            }
            let totalInterest = 0;
            totalInterest = loanAmount+(loanAmount*(interestPercentage/100));
            document.getElementById('totalInterest').value = totalInterest;
            let totalRepayment = loanAmount + totalInterest;
            document.getElementById('totalRepayment').value=totalRepayment;
        }
    </script>
  @endsection
