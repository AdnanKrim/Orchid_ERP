@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                {{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">All General Ledger List</h4>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Account Name</th>
                                    <th >Account Code</th>
                                    <th >Side</th>
                                    <th >Balance</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($charts as $chart)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$chart->AccountName}}</td>
                                        <td>{{$chart->AccountCode}}</td>
                                        <td>{{$chart->Side}}</td>
                                        <td>{{$chart->Balance}}</td>
                                        <td>
                                            <a href="/receivable/{{$chart->id}}" title="Account Receivable Details" class="btn btn-outline-primary btn-sm mx-1">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
