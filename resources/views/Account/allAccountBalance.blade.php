@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-8 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <h4 class="card-header">All Account Balance</h4>
                    <div class="card-body bg-white">
                    <h4 class="text-success">{{Session::get('message')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>accName</th>
                                    <th>AccNo</th>
                                    <th>AccType</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($accs as $value)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$value->accName}}</td>
                                        <td>{{$value->accNo}}</td>
                                        <td>{{$value->accType}}</td>
                                        <td>{{$value->openingBalance}}</td>
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
            function deleteWithdraw(id)
            {
                event.preventDefault();
                var check = confirm('Are you sure want to delete this!');
                if(check)
                {
                    document.getElementById('deleteWithdrawForm'+id).submit();
                }
            }
        </script>
    </div>
@endsection
