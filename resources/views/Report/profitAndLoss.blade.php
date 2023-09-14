@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                {{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Profit & Loss Report</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="{{route('FilterprofitAndLossReport')}}" method="GET">
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
                                    <th >Particulars</th>
                                    <th >Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        @php
                                        $totalIncome = 0;
                                        @endphp
                                        <p> <b>Account Type</b></p>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Income")
                                                <p>{{$type->AccountType}}</p><hr>
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        <p> <b>Account Name</b></p>
                                                        <p>{{$chart->AccountName}}</p><hr>
                                                    @endif
                                                @endforeach
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p> <b>Account Group</b></p>
                                                            <p>{{$group->AccountGroup}}</p><hr>
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                <p> <b>Account Name</b></p>
                                                                <p>{{$chart->AccountName}}</p><hr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <p style="visibility: hidden"> <b>Account Type</b></p>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Income")
                                                <p style="visibility: hidden">{{$type->AccountType}}</p><hr style="visibility: hidden">
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        @if($chart->Side === "Debit")
                                                            <p style="visibility: hidden"> <b>Account Name</b></p>
                                                            <p>+ {{$chart->Balance}} </p><hr>
                                                        @elseif($chart->Side === "Credit")
                                                            <p style="visibility: hidden"> <b>Account Name</b></p>
                                                            <p>- {{$chart->Balance}}</p><hr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p style="visibility: hidden"> <b>Account Group</b></p>
                                                        <p style="visibility: hidden">{{$group->AccountGroup}}</p><hr style="visibility: hidden">
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                @if($chart->Side === "Debit")
                                                                    <p style="visibility: hidden"> <b>Account Name</b></p>
                                                                    <p>+ {{$chart->Balance}} </p><hr>
                                                                @elseif($chart->Side === "Credit")
                                                                    <p style="visibility: hidden"> <b>Account Name</b></p>
                                                                    <p>- {{$chart->Balance}}</p><hr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Income")
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p>Net {{$group->AccountGroup}}</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <p>Net Others</p>
                                        <p>Total Income</p>
                                    </td>
                                    <td>
                                        @foreach($types as $type)
                                            @php
                                                $others = 0;
                                            @endphp
                                            @if($type->AccountType === "Income")

                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        @php
                                                            $value = 0;
                                                        @endphp
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                @if($chart->Side === "Debit")
                                                                    @php
                                                                    $value = $value + $chart->Balance;
                                                                    $totalIncome = $totalIncome + $chart->Balance;
                                                                    @endphp
                                                                @elseif($chart->Side === "Credit")
                                                                    @php
                                                                        $value = $value - $chart->Balance;
                                                                        $totalIncome = $totalIncome - $chart->Balance;
                                                                    @endphp

                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <p>{{$value}}</p>
                                                    @endif
                                                @endforeach
                                                    @foreach($charts as $chart)
                                                        @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                            @if($chart->Side === "Debit")
                                                                @php
                                                                    $others = $others + $chart->Balance;
                                                                    $totalIncome = $totalIncome + $chart->Balance;
                                                                @endphp
                                                            @elseif($chart->Side === "Credit")
                                                                @php
                                                                    $others = $others - $chart->Balance;
                                                                    $totalIncome = $totalIncome - $chart->Balance;
                                                                @endphp
                                                            @endif

                                                        @endif

                                                    @endforeach
                                                    <p>{{$others}}</p>
                                            @endif

                                        @endforeach

                                            <p>{{$totalIncome}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @php
                                            $totalcostOfGood = 0;
                                        @endphp
                                        <p> <b>Account Type</b></p>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Cost of Good Sold")
                                                <p>{{$type->AccountType}}</p><hr>
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        <p> <b>Account Name</b></p>
                                                        <p>{{$chart->AccountName}}</p><hr>
                                                    @endif
                                                @endforeach
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p> <b>Account Group</b></p>
                                                        <p>{{$group->AccountGroup}}</p><hr>
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                <p> <b>Account Name</b></p>
                                                                <p>{{$chart->AccountName}}</p><hr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <p style="visibility: hidden"> <b>Account Type</b></p>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Cost of Good Sold")
                                                <p style="visibility: hidden">{{$type->AccountType}}</p><hr style="visibility: hidden">
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        @if($chart->Side === "Debit")
                                                            <p style="visibility: hidden"> <b>Account Name</b></p>
                                                            <p>+ {{$chart->Balance}} </p><hr>
                                                        @elseif($chart->Side === "Credit")
                                                            <p style="visibility: hidden"> <b>Account Name</b></p>
                                                            <p>- {{$chart->Balance}}</p><hr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p style="visibility: hidden"> <b>Account Group</b></p>
                                                        <p style="visibility: hidden">{{$group->AccountGroup}}</p><hr style="visibility: hidden">
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                @if($chart->Side === "Debit")
                                                                    <p style="visibility: hidden"> <b>Account Name</b></p>
                                                                    <p>+ {{$chart->Balance}} </p><hr>
                                                                @elseif($chart->Side === "Credit")
                                                                    <p style="visibility: hidden"> <b>Account Name</b></p>
                                                                    <p>- {{$chart->Balance}}</p><hr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Cost of Good Sold")
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p>Net {{$group->AccountGroup}}</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                         <p>Net Others</p>
                                         <p>Total Cost of Good Sold</p>
                                    </td>
                                    <td>
                                        @foreach($types as $type)
                                            @php
                                                $others = 0;
                                            @endphp
                                            @if($type->AccountType === "Cost of Good Sold")

                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        @php
                                                            $value = 0;
                                                        @endphp
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                @if($chart->Side === "Debit")
                                                                    @php
                                                                        $value = $value + $chart->Balance;
                                                                        $totalcostOfGood = $totalcostOfGood + $chart->Balance;
                                                                    @endphp
                                                                @elseif($chart->Side === "Credit")
                                                                    @php
                                                                        $value = $value - $chart->Balance;
                                                                        $totalcostOfGood = $totalcostOfGood - $chart->Balance;
                                                                    @endphp

                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <p>{{$value}}</p>
                                                    @endif
                                                @endforeach
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        @if($chart->Side === "Debit")
                                                            @php
                                                                $others = $others + $chart->Balance;
                                                                $totalcostOfGood = $totalcostOfGood + $chart->Balance;
                                                            @endphp
                                                        @elseif($chart->Side === "Credit")
                                                            @php
                                                                $others = $others - $chart->Balance;
                                                                $totalcostOfGood = $totalcostOfGood - $chart->Balance;
                                                            @endphp
                                                        @endif

                                                    @endif
                                                @endforeach
                                                    <p>{{$others}}</p>
                                            @endif

                                        @endforeach

                                        <p>{{$totalcostOfGood}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gross Profit</td>
                                    <td>
                                        @php
                                        $grossProfit = $totalIncome - $totalcostOfGood;
                                        @endphp
                                        <p>{{$grossProfit}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @php
                                            $totalExpenses = 0;
                                        @endphp
                                        <p> <b>Account Type</b></p>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Expenses")
                                                <p>{{$type->AccountType}}</p><hr>
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        <p> <b>Account Name</b></p>
                                                        <p>{{$chart->AccountName}}</p><hr>
                                                    @endif
                                                @endforeach
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p> <b>Account Group</b></p>
                                                        <p>{{$group->AccountGroup}}</p><hr>
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                <p> <b>Account Name</b></p>
                                                                <p>{{$chart->AccountName}}</p><hr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <p style="visibility: hidden"> <b>Account Type</b></p>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Expenses")
                                                <p style="visibility: hidden">{{$type->AccountType}}</p><hr style="visibility: hidden">
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        @if($chart->Side === "Debit")
                                                            <p style="visibility: hidden"> <b>Account Name</b></p>
                                                            <p>+ {{$chart->Balance}} </p><hr>
                                                        @elseif($chart->Side === "Credit")
                                                            <p style="visibility: hidden"> <b>Account Name</b></p>
                                                            <p>- {{$chart->Balance}}</p><hr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p style="visibility: hidden"> <b>Account Group</b></p>
                                                        <p style="visibility: hidden">{{$group->AccountGroup}}</p><hr style="visibility: hidden">
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                @if($chart->Side === "Debit")
                                                                    <p style="visibility: hidden"> <b>Account Name</b></p>
                                                                    <p>+ {{$chart->Balance}} </p><hr>
                                                                @elseif($chart->Side === "Credit")
                                                                    <p style="visibility: hidden"> <b>Account Name</b></p>
                                                                    <p>- {{$chart->Balance}}</p><hr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @foreach($types as $type)
                                            @if($type->AccountType === "Expenses")
                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        <p>Net {{$group->AccountGroup}}</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                            <p>Net Others</p>
                                        <p>Total Expenses</p>
                                    </td>
                                    <td>
                                        @foreach($types as $type)
                                            @php
                                                $others = 0;
                                            @endphp
                                            @if($type->AccountType === "Expenses")

                                                @foreach($groups as $group)
                                                    @if($group->AccountType === $type->id)
                                                        @php
                                                            $value = 0;
                                                        @endphp
                                                        @foreach($charts as $chart)
                                                            @if(!empty($chart->AccountGroup) && $chart->AccountGroup === $group->id)
                                                                @if($chart->Side === "Debit")
                                                                    @php
                                                                        $value = $value + $chart->Balance;
                                                                        $totalExpenses = $totalExpenses + $chart->Balance;
                                                                    @endphp
                                                                @elseif($chart->Side === "Credit")
                                                                    @php
                                                                        $value = $value - $chart->Balance;
                                                                        $totalExpenses = $totalExpenses - $chart->Balance;
                                                                    @endphp

                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <p>{{$value}}</p>
                                                    @endif
                                                @endforeach
                                                @foreach($charts as $chart)
                                                    @if(empty($chart->AccountGroup) && $chart->AccountType === $type->id)
                                                        @if($chart->Side === "Debit")
                                                            @php
                                                                $others = $others + $chart->Balance;
                                                                $totalExpenses = $totalExpenses + $chart->Balance;
                                                            @endphp
                                                        @elseif($chart->Side === "Credit")
                                                            @php
                                                                $others = $others - $chart->Balance;
                                                                $totalExpenses = $totalExpenses - $chart->Balance;
                                                            @endphp
                                                        @endif

                                                    @endif
                                                @endforeach
                                                    <p>{{$others}}</p>
                                            @endif

                                        @endforeach

                                        <p>{{$totalExpenses}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Net Income</td>
                                    <td>
                                        @php
                                            $netIncome = $grossProfit - $totalExpenses;
                                        @endphp
                                        <p>{{$netIncome}}</p>
                                    </td>
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
