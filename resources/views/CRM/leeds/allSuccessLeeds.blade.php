@extends('master.app')
@section('content')
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="col-lg-12 bg-white">
            <div class="card bg-white">
                <div class="card-body bg-white">
{{--                    <h4 class="text-success">{{Session::get('message')}}</h4>--}}
                    <h4 class="card-title mt-2"> Success Leeds List</h4><span><a href="{{route('leeds')}}"><button class="btn btn-success float-right mb-4">+Add</button></a></span>

                    <div class="table-responsive table-bordered">
                        <table class="table mb-0">
                            <thead class="bg-orange">
                            <tr class="text-light">
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Assigned To</th>
                                <th>Client Priority</th>
                                <th>Client Value</th>
                                <th>Source</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leeds as $leed)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$leed->clientName}}</td>
                                    <td>{{$leed->phoneNo}}</td>
                                    <td>{{$leed->email}}</td>
                                    <td>{{Auth()->user()->name}}</td>
                                    <td>{{$leed->clientPriority}}</td>
                                    <td>{{$leed->clientValue}}</td>
                                    <td>{{$leed->source}}</td>
                                    <td>
                                        <a href="{{route('editLeeds', ['id'=>$leed->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('success-leeds-panel', ['id'=>$leed->id])}}" title="Go To Details" class="btn btn-warning btn-sm text-light mx-1">
                                            <i class="fa fa-book"></i>
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm" onclick="deleteLeed({{$leed->id}})">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form method="POST" action="{{route('deleteLeeds',['id' => $leed->id])}}" id="deleteLeedForm{{$leed->id}}">
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
        function deleteLeed(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteLeedForm'+id).submit();
            }
        }
    </script>
    <script>
        function create()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Leed is set to Success Successfully'
            })
        }
        function wise_words()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Company Information Deleted Successfully'
            })
        }
        function update()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Company Information Updated Successfully'
            })
        }
    </script>
</div>
@endsection
