@extends('master.app')
@section('content')
@if(Session::has('Error_Message'))
            <li>
                <p class="show">
                    <script type="text/javascript">
                        window.onload = function() {
                            document.getElementById(".showcode").innerHTML = error();
                        }
                    </script>
                </p>
            </li>
        @endif
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Employee Details</h4>
                    <div class="card-body bg-white">
                        <!--Side Bar code-->
                    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/Employee-Info/{{$user->id}}" class="nav-link align-middle px-0">
                        <i class="bi bi-person-fill"></i> <span class="ms-1 d-none d-sm-inline">Basic Information</span>
                        </a>
                    </li>

                    <li>
                        <a href="/Employee-Image/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-camera-fill"></i> <span class="ms-1 d-none d-sm-inline">Profile Picture</span></a>
                    </li>


                    <li>
                        <a href="/Employee-Immigration/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-people-fill"></i> <span class="ms-1 d-none d-sm-inline">Immigration</span> </a>
                    </li>

                    <li>
                        <a href="/Employee-Econtact/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-telephone-fill"></i> <span class="ms-1 d-none d-sm-inline">Emergency Contact</span> </a>
                    </li>

                    <li>
                        <a href="/Employee-social/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-people-fill"></i> <span class="ms-1 d-none d-sm-inline">Social Networking</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-document/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-file-earmark-fill"></i> <span class="ms-1 d-none d-sm-inline">Document</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-qualification/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-journal-arrow-down"></i> <span class="ms-1 d-none d-sm-inline">Qualification</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-experience/{{$user->id}}" class="nav-link px-0 align-middle active p-2">
                        <i class="bi bi-hourglass-split"></i> <span class="ms-1 d-none d-sm-inline">Work Experience</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-bank/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-laptop-fill"></i> <span class="ms-1 d-none d-sm-inline">Bank Account</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-contract/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-pen-fill"></i> <span class="ms-1 d-none d-sm-inline">Contract</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-leave/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-cup-hot-fill"></i> <span class="ms-1 d-none d-sm-inline">Leave</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-shift/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-clock-history"></i> <span class="ms-1 d-none d-sm-inline">Shift</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-location/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-arrows-fullscreen"></i> <span class="ms-1 d-none d-sm-inline">Location</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-Password/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-key-fill"></i> <span class="ms-1 d-none d-sm-inline">Change Password</span> </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                        <i class="bi bi-laptop-fill"></i> <span class="ms-1 d-none d-sm-inline">Custom Field</span> </a>
                    </li>
                </ul>
                <hr>

            </div>
        </div>
        <div class="col py-3">
            <!-- Content Area -->
            <div class="card bg-white">
            <h4 class="card-header" id="header">Add New Work Experience</h4>
                <div class="card-body bg-white">
                <form action="{{route('WorkExperiencePost')}}" class="form-group" id="StoreInfo" method="POST" enctype="multipart/form-data">
                <input class="form-control" type="hidden" name="id" id="id" value="{{$user->id}}">
                <input class="form-control" type="hidden" name="workId" id="workId">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="name">Company Name</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Company Name">
                                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="post">Post</label>
                                        <input class="form-control" type="text" name="post" id="post" placeholder="Post">
                                        <span class="text-danger">@error('post'){{ $message }}@enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="from">From</label>
                                        <input class="form-control" type="date" name="from" id="from">
                                        <span class="text-danger">@error('from'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="to">To</label>
                                        <input class="form-control" type="date" name="to" id="to" >
                                        <span class="text-danger">@error('to'){{ $message }}@enderror</span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" id="submit" value="Save"/>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
            <div class="card bg-white">
            <h4 class="card-header">list All Work Experience</h4>
            <div class="card-body bg-white">
            <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Company Name</th>
                                    <th >From Date</th>
                                    <th >To Date</th>
                                    <th >Post</th>
                                    <th >Description</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($experiences as $experience)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$experience->CompanyName}}</td>
                                <td>{{$experience->From}}</td>
                                <td>{{$experience->To}}</td>
                                <td>{{$experience->Post}}</td>
                                <td>{{$experience->Description}}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-success btn-sm me-1" title="Update" id="update" data-url="{{route('GetWorkExperience',$experience->id)}}">
                                    <i class="fa fa-edit"></i>
                                    </a>
                                    <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{route('GetWorkExperience',$experience->id)}}" >
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
            <!-- Content Area -->
        </div>
    </div>
</div>
<!--Side Bar code-->

                </div>
            </div>
        </div>
    </div>
     <!--Modal and JS-->
     <!-- Delete Modal -->
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Work Experience Delete</h5>
                </div>
                <div class="modal-body">
                        <span class="text-dark">Are you sure to delete this Work Experience?</span>
                </div>
                <div class="modal-footer">
                <form action="{{route('DeleteWorkExperience')}}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="user-id" name="id">
                    <input type="submit" class="btn btn-danger me-2" id="yes" value="Yes">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('body').on('click', '#delete', function () {
                var userURL = $(this).data('url');
                $.get(userURL, function (data) {
                    $('#deleteModal').modal('show');
                    $('#user-id').val(data.id);

                })
            });
        });

        $(document).ready(function () {
            $('body').on('click', '#update', function () {
                $('#header').text('Update Work Experience')
                $('#submit').val('Update')
                $('#StoreInfo').attr('action','/Employee-WorkExperience-Update');
                var userURL = $(this).data('url');
                $.get(userURL, function (data) {
                    $('#workId').val(data.id);
                    $('#name').val(data.CompanyName);
                    $('#post').val(data.Post);
                    $('#from').val(data.From);
                    $('#to').val(data.To);
                    $('#description').val(data.Description);
                })
            });
        });
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
                title: 'Work Experience Inserted Successfully'
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
                icon: 'error',
                title: 'Work Experience Deleted Successfully'
            })
        }
        function error()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'warning',
                title: 'Invalid Date'
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
                title: 'Work Experience Updated Successfully'
            })
        }

    </script>


@endsection
