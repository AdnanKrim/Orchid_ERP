@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-8 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <h4 class="card-header">All Accounts</h4>
                    <div class="card-body bg-white">
                    <h4 class="text-success">{{Session::get('message')}}</h4>
                        <span class="float-right mb-2"><a href="{{route('add.account')}}" class="btn btn-success">+Add</a></span>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>accName</th>
                                    <th>AccNo</th>
                                    <th>AccType</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($accs as $value)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$value->accName}}</td>
                                        <td>{{$value->accNo}}</td>
                                        <td>{{$value->accType}}</td>
                                        <td>{{$value->status}}</td>
                                        <td>
                                            <a href="{{route('edit.account', ['id'=>$value->id])}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm mx-1" onclick="deleteAccount({{$value->id}})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form method="POST" action="{{route('delete.account',['id' => $value->id])}}" id="deleteAccountForm{{$value->id}}">
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
            function deleteAccount(id)
            {
                event.preventDefault();
                var check = confirm('Are you sure want to delete this!');
                if(check)
                {
                    document.getElementById('deleteAccountForm'+id).submit();
                }
            }
        </script>
    </div>
@endsection
