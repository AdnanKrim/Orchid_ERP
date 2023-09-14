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
                    <h4 class="card-header">Shift List</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="#" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="shiftSearch" id="shiftSearch" onkeyup="myFunction()" placeholder="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="{{route('addShiftSchedule')}}" class="btn btn-success float-right">+Add</a></span>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th >Day Name</th>
                                    <th >Friday</th>
                                    <th >Saturday</th>
                                    <th>Sunday</th>
                                    <th >Monday</th>
                                    <th >Tuesday</th>
                                    <th >Wednesday</th>
                                    <th >Thursday</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($shifts as $shift)
                                    <tr>
                                        <th>{{$shift->shiftName}}</th>
                                        <td>
                                        @php
                                        $datas = json_decode($shift->time);
                                        $inTime = "-----";
                                        $outTime = "-----";
                                        foreach ($datas as $data) {
                                            if($data->dayName === "Friday"){
                                                $inTime = $data->inTime;
                                                $outTime = $data->outTime;
                                            }
                                        }
                                        @endphp
                                        {{$inTime}} to {{$outTime}}
                                        </td>
                                        <td>
                                        @php
                                        $datas = json_decode($shift->time);
                                        $inTime = "-----";
                                        $outTime = "-----";
                                        foreach ($datas as $data) {
                                            if($data->dayName === "Saturday"){
                                                $inTime = $data->inTime;
                                                $outTime = $data->outTime;
                                            }
                                        }
                                        @endphp
                                        {{$inTime}} to {{$outTime}}
                                        </td>
                                        <td>
                                        @php
                                        $datas = json_decode($shift->time);
                                        $inTime = "-----";
                                        $outTime = "-----";
                                        foreach ($datas as $data) {
                                            if($data->dayName === "Sunday"){
                                                $inTime = $data->inTime;
                                                $outTime = $data->outTime;
                                            }
                                        }
                                        @endphp
                                        {{$inTime}} to {{$outTime}}
                                        </td>
                                        <td>
                                        @php
                                        $datas = json_decode($shift->time);
                                        $inTime = "-----";
                                        $outTime = "-----";
                                        foreach ($datas as $data) {
                                            if($data->dayName === "Monday"){
                                                $inTime = $data->inTime;
                                                $outTime = $data->outTime;
                                            }
                                        }
                                        @endphp
                                        {{$inTime}} to {{$outTime}}
                                        </td>
                                        <td>
                                        @php
                                        $datas = json_decode($shift->time);
                                        $inTime = "-----";
                                        $outTime = "-----";
                                        foreach ($datas as $data) {
                                            if($data->dayName === "Tuesday"){
                                                $inTime = $data->inTime;
                                                $outTime = $data->outTime;
                                            }
                                        }
                                        @endphp
                                        {{$inTime}} to {{$outTime}}
                                        </td>
                                        <td>
                                        @php
                                        $datas = json_decode($shift->time);
                                        $inTime = "-----";
                                        $outTime = "-----";
                                        foreach ($datas as $data) {
                                            if($data->dayName === "Wednesday"){
                                                $inTime = $data->inTime;
                                                $outTime = $data->outTime;
                                            }
                                        }
                                        @endphp
                                        {{$inTime}} to {{$outTime}}
                                        </td>
                                        <td>
                                        @php
                                        $datas = json_decode($shift->time);
                                        $inTime = "-----";
                                        $outTime = "-----";
                                        foreach ($datas as $data) {
                                            if($data->dayName === "Thursday"){
                                                $inTime = $data->inTime;
                                                $outTime = $data->outTime;
                                            }
                                        }
                                        @endphp
                                        {{$inTime}} to {{$outTime}}
                                        </td>
                                        <td>
                                            <a href="/shift-schedule-edit/{{$shift->id}}" class="btn btn-success btn-sm me-1" title="Update">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{route('getShiftScheduleInformation',$shift->id)}}" >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <th>Default Off day</th>
                                        <td>
                                        @foreach($days as $day)
                                                @if($day->dayName === "Friday")
                                                @if($day->offDay === 1) Yes @elseif($day->offDay === 0) No @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($days as $day)
                                                @if($day->dayName === "Saturday")
                                                @if($day->offDay === 1) Yes @elseif($day->offDay === 0) No @endif

                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($days as $day)
                                                @if($day->dayName === "Sunday")
                                                @if($day->offDay === 1) Yes @elseif($day->offDay === 0) No @endif

                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($days as $day)
                                                @if($day->dayName === "Monday")
                                                @if($day->offDay === 1) Yes @elseif($day->offDay === 0) No @endif

                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($days as $day)
                                                @if($day->dayName === "Tuesday")
                                                @if($day->offDay === 1) Yes @elseif($day->offDay === 0) No @endif

                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($days as $day)
                                                @if($day->dayName === "Wednesday")
                                                @if($day->offDay === 1) Yes @elseif($day->offDay === 0) No @endif

                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($days as $day)
                                                @if($day->dayName === "Thursday")
                                                @if($day->offDay === 1) Yes @elseif($day->offDay === 0) No  @endif
                                                @endif
                                            @endforeach
                                        </td>

                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Shift Schedule Delete</h5>
                </div>
                <div class="modal-body">
                    <span class="text-dark">Are you sure to delete this Shift Schedule?</span>
                </div>
                <div class="modal-footer">
                <form action="{{route('deleteShiftSchedule')}}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="user-id" name="id">
                    <input type="submit" class="btn btn-danger me-1" id="yes" value="Yes">
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
                title: 'Shift Schedule added successfully'
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
                title: 'Already a schedule for this shift in this time'
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
                title: 'Shift Schedule Delete Successfully'
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
                title: 'Shift Schedule Updated Successfully'
            })
        }

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("shiftSearch");
            filter = input.value.toUpperCase();
             table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                 td = tr[i].getElementsByTagName("th")[0];
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
