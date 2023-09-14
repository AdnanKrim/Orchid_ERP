@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <div class="card-body bg-white">
                        <h4 class="text-success">{{Session::get('message')}}</h4>
                        <h4 class="card-title mt-2"> Search Result </h4><span><a href="{{route('business-branch')}}"><button class="btn btn-success float-right mb-4">  Back </button></a></span>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Business Branch Name</th>
                                    <th>Business Branch Head</th>
                                    <th>Company Id</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Address</th>
                                    <th colspan="2">Branch Location</th>
                                    <th colspan="2">Note</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($branchInfos as $branchInfo)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$branchInfo->branchName}}</td>
                                        <td>{{$branchInfo->branchHead}}</td>
                                        <td>{{$branchInfo->companyId}}</td>
                                        <td>{{$branchInfo->city}}</td>
                                        <td>{{$branchInfo->state}}</td>
                                        <td>{{$branchInfo->country}}</td>
                                        <td>{{$branchInfo->phoneNo}}</td>
                                        <td>{{$branchInfo->email}}</td>
                                        <td>{{$branchInfo->status}}</td>
                                        <td>{{$branchInfo->address}}</td>
                                        <td colspan="2">{{$branchInfo->branchLocation}}</td>
                                        <td colspan="2">{{$branchInfo->note}}</td>
                                        <td>
                                            <a href="{{route('editBusinessBranch',['id'=>$branchInfo->id])}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm" onclick="deleteGroup({{$branchInfo->id}})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('deleteBranch',['id'=> $branchInfo->id]) }}" method="POST" id="deleteBranch{{$branchInfo->id}}" >
                                                @csrf
                                            </form>
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
        <script>
            function deleteGroup(id)
            {
                event.preventDefault();
                var check = confirm('Are you sure want to delete this!');
                if(check)
                {
                    document.getElementById('deleteBranch'+id).submit();
                }
            }
        </script>
    </div>
@endsection
