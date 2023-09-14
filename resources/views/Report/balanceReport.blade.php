@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                {{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Balance Report</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="{{route('filterBalancereport')}}" method="GET">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="from">From</label>
                                        <input class="form-control" type="date" name="from" id="from">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="to">To</label>
                                        <input class="form-control" type="date" name="to" id="to">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="Filter"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Particulars</th>
                                    <th >Debit</th>
                                    <th >Credit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $debitTotal = 0;
                                $creditTotal = 0;
                                @endphp
                                @foreach ($charts as $chart)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$chart->AccountName}}</td>
                                        <td>
                                            @if($chart->Side === "Debit")
                                                {{$chart->Balance}}
                                                @php
                                                    $debitTotal = $debitTotal + $chart->Balance;
                                                @endphp
                                            @endif
                                        </td>
                                        <td>
                                            @if($chart->Side === "Credit")
                                                {{$chart->Balance}}
                                                @php
                                                    $creditTotal = $creditTotal + $chart->Balance;
                                                @endphp
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="2" style="text-align: center">Total</th>
                                    <td>{{$debitTotal}}</td>
                                    <td>{{$creditTotal}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
