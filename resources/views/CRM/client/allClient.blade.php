@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Client List</h4>
                    <div class="card-body bg-white">

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Project Start Date</th>
                                    <th >Project Category</th>
                                    <th >Client Name</th>
                                    <th >Mobile Number</th>
                                    <th >Email</th>
                                    <th >Client Priority</th>
                                    <th >Total Project Amount</th>
                                    <th >Paid</th>
                                    <th >Payment Due</th>
                                    <th >Assign to</th>
                                    <th >Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deals as $deal)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$deal->startDate}}</td>
                                        <td>
                                            @foreach($categories as $category)
                                            @if($category->id===$deal->category)
                                            {{$category->projectCategoryName}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($clients as $client)
                                            @if($client->id===$deal->ClientName)
                                            {{$client->clientName}}
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($clients as $client)
                                            @if($client->id===$deal->ClientName)
                                            {{$client->phoneNo}}
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($clients as $client)
                                            @if($client->id===$deal->ClientName)
                                            {{$client->email}}
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>
                                        @foreach($clients as $client)
                                            @if($client->id===$deal->ClientName)
                                            {{$client->clientPriority}}
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>{{$deal->amount}} BDT</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        @foreach($clients as $client)
                                        @foreach($users as $user)
                                            @if($client->assignedTo===$user->id)
                                            {{$user->name}}
                                            @endif
                                        @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                            @if($deal->status === "Running")
                                            <p class="badge bg-warning text-dark">{{$deal->status}}</p>
                                            @elseif($deal->status==="Completed")
                                            <p class="badge bg-success">{{$deal->status}}</p>
                                            @elseif($deal->status==="Rejected")
                                            <p class="badge bg-danger">{{$deal->status}}</p>
                                            @endif
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
