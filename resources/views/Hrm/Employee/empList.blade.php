@extends('master.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">All Employees</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="query" id="employeeSearch" onkeyup="myFunction()" placeholder="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="{{route('empCreateForm')}}" class="btn btn-success float-right">+Add</a></span>
                                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Name</th>
                                    <th >Employee</th>
                                    <th >Date of joining</th>
                                    <th >Department</th>
                                    <th >Designation</th>
                                    <th >Role</th>
                                    <th >Gender</th>
                                    <th >Date of Birth</th>
                                    <th >Photo</th>
                                    <th >Phone</th>
                                    <th >Department Head</th>
                                    <th >Email</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        @if(empty($user->name))
                                        <td>----</td>
                                        @else
                                        <td>{{$user->name}}</td>
                                        @endif
                                        @if(empty($user->employeeId))
                                        <td>----</td>
                                        @else
                                        <td>{{$user->employeeId}}</td>
                                        @endif

                                        @if(empty($user->dateOfJoining))
                                        <td>----</td>
                                        @else
                                        <td>{{$user->dateOfJoining}}</td>
                                        @endif

                                        @if(empty($user->departmentId))
                                        <td>----</td>
                                        @else
                                        @foreach($departments as $department)
                                        @if($user->departmentId === $department->id)
                                        <td>{{$department->departmentName}}</td>
                                        @endif
                                        @endforeach
                                        @endif

                                        @if(empty($user->designationId))
                                        <td>----</td>
                                        @else
                                        @foreach($designations as $designation)
                                        @if($user->designationId === $designation->id)
                                        <td>{{$designation->designationName}}</td>
                                        @endif
                                        @endforeach
                                        @endif

                                        @if(empty($user->roleId))
                                        <td>----</td>
                                        @else
                                        @foreach($roles as $role)
                                        @if($user->roleId === $role->id)
                                        <td>{{$role->role}}</td>
                                        @endif
                                        @endforeach
                                        @endif

                                        @if(empty($user->gender))
                                        <td>----</td>
                                        @else
                                        <td>{{$user->gender}}</td>
                                        @endif

                                        @if(empty($user->dateOfBarth))
                                        <td>----</td>
                                        @else
                                        <td>{{$user->dateOfBarth}}</td>
                                        @endif

                                        @if(empty($user->photo))
                                        <td><img src="../employeeImages/index.png" alt="Employee Image" width="60" height="60"></td>
                                        @else
                                        <td><img src="../employeeImages/{{$user->photo}}" alt="Employee Image" width="60" height="60"></td>
                                        @endif

                                        @if(empty($user->phone))
                                        <td>----</td>
                                        @else
                                        <td>{{$user->phone}}</td>
                                        @endif
                                        <td>
                                            @foreach($departments as $department)
                                                @if($user->departmentId === $department->id)
                                                    {{$department->departmentHead}}
                                                    @foreach($users as $head)
                                                        @if($head->departmentId ===$department->departmentHead )
                                                            {{$head->name}}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        @if(empty($user->email))
                                        <td>----</td>
                                        @else
                                        <td>{{$user->email}}</td>
                                        @endif


                                        <td>
                                            <a href="/Employee-Info/{{$user->id}}" class="btn btn-light  btn-sm me-1" title="Show">
                                            <i class="bi bi-arrow-right-circle-fill"></i>
                                            </a>
                                            <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{route('GetEmployeeInfo',$user->id)}}" >
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
    </div>
    <!--Modal and JS-->
     <!-- Delete Modal -->
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Employee Delete</h5>
                </div>
                <div class="modal-body">
                        <span class="text-dark">Are you sure to delete this Employee?</span>
                </div>
                <div class="modal-footer">
                <form action="{{route('DeleteEmployee')}}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="user-id" name="id">
                    <input type="submit" class="btn btn-danger" id="yes" value="Yes">
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

    </script>
    <script>
                function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("employeeSearch");
            filter = input.value.toUpperCase();
             table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                 td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        } else {
                        tr[i].style.display = "none";
            }
        }
     }
}
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
                title: 'Employee Inserted Successfully'
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
                title: 'Employee Deleted Successfully'
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
                title: 'Employee Updated Successfully'
            })
        }

    </script>


@endsection
