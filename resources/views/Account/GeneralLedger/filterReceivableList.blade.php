@extends('master.app')
@section('content')
    <style>
        select {
            min-width: 10em;
            padding: 0.5em 1em;
            background: transparent;
            border: #444 solid;
            border-radius: 1em;
            color: inherit;
            font: inherit;
        }
        .fixed option {
            background: indigo;
        }
        select.solid {
            background: #222;
        }
        body {
            min-height: 100vh;
            background: repeating-linear-gradient(45deg, #222, #111 0.5em, #222 2em);
            color: white;
            font-family: sans-serif;
        }
        main {
            display: flex;
        }
        @media (max-width: 40em) {
            main {
                flex-wrap: wrap;
            }
        }
        figure {
            display: inline-block;
            display: inline-flex;
            flex-direction: column;
            margin: 1em;
            width: calc(33% - 2em);
            min-width: 10em;
            flex: 1 auto;
        }
        label {
            margin-bottom: 1em;
        }
        select {
            display: block;
            margin-top: auto;
        }
        option {
            font: inherit;
        }
        code {font-size: inherit;}
        a:link {color: deepSkyBlue;}
        a:visited {color: lightSkyBlue;}
    </style>
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                {{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select class="fixed" style="background:none;border:none;" data-live-search="true" onchange="SwitchAccount(this.value)">
                                    @foreach($allCharts as $allChart)
                                        <option @if($allChart->id === $chart->id) selected @endif value="{{$allChart->id}}">{{$allChart->AccountName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 ml-0">
                                <p class="float-right col-md-6"> Side: {{$chart->Side}}</p>
                            </div>
                        </div>
                    </h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="#" method="GET">
                                <input class="form-control" type="hidden" name="id" id="id" value="{{$chart->id}}">
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
                                    <th >Date</th>
                                    <th >Particulars</th>
                                    <th >JV No</th>
                                    <th >Debit</th>
                                    <th >Credit</th>
                                    <th >Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $balance = 0;
                                @endphp
                                @foreach ($journals as $journal)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$journal->date}}</td>
                                        <td>
                                            @foreach($otherjournals as $otherjournal)
                                                @if($otherjournal->date === $journal->date)
                                                    @foreach($allCharts as $allChart)
                                                        @if($allChart->id === $otherjournal->chartOfAccountId)
                                                            @if($allChart->Side === $chart->Side)
                                                                By {{$allChart->AccountName}} <hr>
                                                            @else
                                                                To {{$allChart->AccountName}}<hr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$journal->JVNo}}</td>
                                        <td>{{$journal->debit}}</td>
                                        <td>{{$journal->credit}}</td>
                                        <td>
                                            @if($chart->Side === "Debit")
                                                @php
                                                    $balance = $balance+$journal->debit;
                                                    $balance = $balance-$journal->credit;
                                                @endphp
                                                {{$balance}}
                                            @endif
                                            @if($chart->Side === "Credit")
                                                @php
                                                    $balance = $balance+$journal->credit;
                                                    $balance = $balance-$journal->debit;
                                                @endphp
                                                {{$balance}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4" style="text-align: center">Total</th>
                                    <td>{{$debit}}</td>
                                    <td>{{$credit}}</td>
                                    <td>{{$balance}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function SwitchAccount(id){
            window.location.href=`/receivable/${id}`;
        }
    </script>
@endsection
