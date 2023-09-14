@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <div class="card-body bg-white">
                        <h4 class="text-success">{{Session::get('message')}}</h4>
                        <h4 class="card-title mt-2"> Search Result </h4><span><a href="{{route('allCompanyInfo')}}"><button class="btn btn-success float-right                                      mb-4">  Back </button></a></span>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Logo</th>
                                    <th>Fav Icon</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th colspan="2">Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Slogan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($companyInfo as $companyInfo)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$companyInfo->companyName}}</td>
                                        <td><img src="{{ asset($companyInfo->logo) }}" width= '50' height='50' class="img img-responsive" /></td>
                                        <td><img src="{{ asset($companyInfo->favicon) }}" width= '50' height='50' class="img img-responsive" /> </td>
                                        <td>{{$companyInfo->phone}}</td>
                                        <td>{{$companyInfo->email}}</td>
                                        <td colspan="2">{{$companyInfo->address}}</td>
                                        <td>{{$companyInfo->city}}</td>
                                        <td>{{$companyInfo->state}}</td>
                                        <td>{{$companyInfo->country}}</td>
                                        <td>{{$companyInfo->slogan}}</td>
                                        <td>
                                            <a href="{{route('editCompanyInfo',['id'=>$companyInfo->id])}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm" onclick="deleteGroup({{$companyInfo->id}})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('deleteCompanyInfo',['id'=> $companyInfo->id]) }}" method="POST" id="deleteCompanyInfo{{$companyInfo->id}}" >
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
                    document.getElementById('deleteCompanyInfo'+id).submit();
                }
            }
        </script>
    </div>
@endsection
