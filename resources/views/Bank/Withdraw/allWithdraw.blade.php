@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-8 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <h4 class="card-header">All Deposit</h4>
                    <div class="card-body bg-white">
                    <h4 class="text-success">{{Session::get('message')}}</h4>
                        <span class="float-right mb-2"><a href="{{route('add.withdraw')}}" class="btn btn-success">+Add</a></span>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>date</th>
                                    <th>Bank</th>
                                    <th>Acc Name</th>
                                    <th>Acc No</th>
                                    <th>Branch</th>
                                    <th>amount</th>
                                    <th>checkNo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($withdraws as $value)
                                    <?php
                                    $v = \App\Models\Bank\Bank::where('id',$value->bankId)->first();
                                    ?>
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$value->date}}</td>
                                        <td>{{$v->name}}</td>
                                        <td>{{$v->accName}}</td>
                                        <td>{{$v->accNo}}</td>
                                        <td>{{$v->branch}}</td>
                                        <td>{{$value->amount}}</td>
                                        <td>{{$value->checkNo}}</td>
                                        <td>
                                            <a href="{{route('edit.withdraw', ['id'=>$value->id])}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm mx-1" onclick="deleteWithdraw({{$value->id}})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form method="POST" action="{{route('delete.withdraw',['id' => $value->id])}}" id="deleteWithdrawForm{{$value->id}}">
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
