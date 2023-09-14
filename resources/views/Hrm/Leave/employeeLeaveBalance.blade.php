@extends('master.app')
@section('content')

    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">All Apply Leave</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="#" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="applyLeaveSearch" id="applyLeaveSearch" onkeyup="myFunction()" placeholder="Search"/>
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th >#</th>
                                    <th >Employee Name</th>
                                    <th >Employee Id</th>
                                    <th >Employee Type</th>
                                    <th >Leave Type</th>
                                    <th >Entitled</th>
                                    <th >Used Leave</th>
                                    <th >Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <b>{{$user->name}}</b>,<br>
                                            @foreach($designations as $designation)
                                            @if($designation->id === $user->designationId)
                                            {{$designation->designationName}},
                                            <br>
                                            @endif
                                            @endforeach
                                            @foreach($departments as $department)
                                            @if($department->id === $user->departmentId)
                                            {{$department->departmentName}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$user->employeeId}}
                                        </td>
                                        <td>
                                        @foreach($designations as $designation)
                                            @if($designation->id === $user->designationId)
                                            {{$designation->attendanceType}}
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>
                                            @foreach($leaveTypes as $leave)
                                            {{$leave->leaveType}} <hr style="height:1px;border:none;color:#000000;background-color:#000000;">
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($leaveTypes as $leave)
                                            {{$leave->NumberOfLeave}} <hr style="height:1px;border:none;color:#000000;background-color:#000000;">
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($leaveTypes as $leave)
                                            @foreach($applyLeaves as $applyLeave)
                                            @if($applyLeave->LeaveType===$leave->id && $applyLeave->Employee===$user->id)
                                            {{$applyLeave->totalDays}} <hr>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </td>
                                        <td></td>
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("applyLeaveSearch");
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
    </script>

@endsection
