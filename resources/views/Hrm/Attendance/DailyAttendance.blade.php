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
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Daily Attendance</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="{{route('filterAttendance')}}" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-4">
                                        <input type="date" class="form-control bg-white" name="date" id="date" value="<?= date('Y-m-d', time()); ?>"/>
                                    </label>
                                    <label class="col-md-4">
                                    <div class="input-group search_select_box">
                                        <select class="form-control" name="employee" id="employee" data-live-search="true">
                                            <option value="">All Employee</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                    </label>
                                    <div class="col-md-4 ml-0">
                                        <span class="float-right col-md-6"><a href="{{route('Attendance')}}" class="btn btn-success float-right">+Add</a></span>
                                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>Total Employees</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Late</th>
                                    <th>Early Exit</th>
                                    <th>Leave</th>
                                    <th>Day Off</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$users->count()}}</td>
                                        <td>{{$present->count()}}</td>
                                        <td>{{$absent->count()}}</td>
                                        <td>{{$late->count()}}</td>
                                        <td>{{$earlyExit->count()}}</td>
                                        <td>{{$leaves->count()}}</td>
                                        <td>{{$offDayEmployees->count()}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Employee Id</th>
                                    <th>Employment Type</th>
                                    <th>Shift Name</th>
                                    <th>Status</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Late</th>
                                    <th>Early Exit</th>
                                    <th>Working Hour</th>
                                    <th>OT Hour</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($todaysUser as $user)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->employeeId}}</td>
                                        <td>
                                            @foreach($designations as $designation)
                                            @if($user->designationId === $designation->id)
                                            {{$designation->designationName}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($shifts as $shift)
                                            @if($user->shift === $shift->shiftName)
                                            {{$shift->shiftName}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($attendances as $attendance)
                                                @if($attendance->Employee === $user->id)
                                                    @if($attendance->Status === 0)
                                                        <span class="badge text-bg-danger">Absent</span>
                                                    @elseif($attendance->Status === 1)
                                                        <span class="badge text-bg-success">Present</span>
                                                    @endif
                                                @endif
                                            @endforeach

                                        </td>
                                        <td>
                                            @foreach($attendances as $attendance)
                                                @if($attendance->Employee === $user->id)
                                                    @if(empty($attendance->InTime))
                                                        -----
                                                    @else
                                                        {{$attendance->InTime}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($attendances as $attendance)
                                                @if($attendance->Employee === $user->id)
                                                    @if(empty($attendance->OutTime))
                                                        -----
                                                    @else
                                                        {{$attendance->OutTime}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-danger">
                                            @foreach($attendances as $attendance)
                                                @if($attendance->Employee === $user->id)
                                                    @php
                                                    $late = (double) $attendance->Late;
                                                    if ($late<1){
                                                        $lateMin = $late*60;
                                                    }
                                                    @endphp
                                                @endif
                                            @if($late<1)
                                                {{$lateMin}} Min
                                                    @else
                                                {{$late}} Hour
                                                    @endif
                                            @endforeach
                                        </td>
                                        <td class="text-warning">
                                            @foreach($attendances as $attendance)
                                                @if($attendance->Employee === $user->id)
                                                    @php
                                                        $early = (double) $attendance->EarlyExit;
                                                        if ($early<1){
                                                            $earlyMin = $early*60;
                                                        }
                                                    @endphp
                                                @endif
                                                @if($early<1)
                                                    {{$earlyMin}} Min
                                                @else
                                                    {{$early}} Hour
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($attendances as $attendance)
                                                @if($attendance->Employee === $user->id)
                                                    @php
                                                        $working = (double) $attendance->WorkingHour;
                                                        if ($working<1){
                                                            $workingMin = $working*60;
                                                        }
                                                    @endphp
                                                @endif
                                                @if($working<1)
                                                    {{$workingMin}} Min
                                                @else
                                                    {{$working}} Hour
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-success">
                                            @foreach($attendances as $attendance)
                                                @if($attendance->Employee === $user->id)
                                                    @php
                                                        $ot = (double) $attendance->OtHour;
                                                        if ($ot<1){
                                                            $otMin = $ot*60;
                                                        }
                                                    @endphp
                                                @endif
                                                @if($ot<1)
                                                    {{$otMin}} Min
                                                @else
                                                    {{$ot}} Hour
                                                @endif
                                            @endforeach
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                title: 'Attendance Given Successfully'
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
                title: 'Attendance already taken'
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
                title: 'Grant Loan Deleted Successfully'
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
                title: 'Attendance Filtered Updated Successfully'
            })
        }
    </script>

@endsection
