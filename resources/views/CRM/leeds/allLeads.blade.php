@extends('master.app')
@section('content')
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="col-lg-12 bg-white">
            <div class="card bg-white">
                <div class="card-body bg-white">
{{--                    <h4 class="text-success">{{Session::get('message')}}</h4>--}}
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="..." class="rounded mr-2" alt="...">
                            <strong class="mr-auto">Bootstrap</strong>
                            <small>11 mins ago</small>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Hello, world! This is a toast message.
                        </div>
                    </div>


                    <h4 class="card-title mt-2">All Leeds List</h4><span><a href="{{route('leeds')}}"><button class="btn btn-success float-right mb-4">+Add</button></a></span>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="bg-orange ">
                            <tr class="text-light">
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Assigned To</th>
                                <th>Client Priority</th>
                                <th>Client Value</th>
                                <th>Source</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="">
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
                                    <td>{{$leed->status}}</td>
                                    <td>
                                        <a href="{{route('editLeeds', ['id'=>$leed->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('promote-demote-leed', ['id'=>$leed->id])}}" title="Convert To Success Leed" class="btn btn-outline-warning btn-sm mx-1">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('getLeeds', $leed->id) }}" >
                                            <i class="fa fa-trash"></i>
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
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title text-center text-danger">Leed Delete</h5>
                </div>
                <div class="modal-body">
                    <span class="text-dark text-center">Are You Sure to Delete This Leed?</span>
                </div>
                <div class="modal-footer">
                    <form action="{{route('deleteLeeds')}}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="user-id" name="id">
                        <input type="submit" class="btn btn-danger btn-sm" id="yes" value="Yes">
                        <button type="button" class="btn btn-primary btn-sm mx-1" data-bs-dismiss="modal" >No</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    //-----------cancel ride---------------
    $(document).ready(function () {

        $('body').on('click', '#delete', function () {
            var userURL = $(this).data('url');
            $.get(userURL, function (data) {
                $('#deleteModal').modal('show');
                $('#user-id').val(data.id);

            })
        });
    });
</script>
@endsection
