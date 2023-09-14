@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="col-md-12 card mr-4">
{{--        <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
        @if($meetings->toArray() == null)
            <h2 class="text-center text-success mt-3">No Meeting Scheduled!</h2>
            <h5 class="text-center">Please <a href="{{route('add-meeting',['id'=>$leed->id])}}"><u>Click Here</u></a> to Add Meeting...</h5>
        @else
            <div class="card-title py-2">
                <a href="{{route('add-meeting',['id'=>$leed->id])}}" class="btn btn-success float-right btn-sm">+Add</a>
            </div>
            <div class="card">
                <div class="row g-0">
                    @foreach ($meetings as $meeting)
                        <div class="col-md-4">
                            <div class="card mt-5 bg-dark" style="max-width: 150px; max-height: 30px;">
                                <div class="card-title ml-2">
                                    <h1 class="text-white text-lg">{!! date('d M y', strtotime($meeting->meetingDateAndTime)) !!}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 mb-0">
                            <div class="card-body ">
                                <h4 class=""><b>{!! date('h:i A', strtotime($meeting->meetingDateAndTime)) !!}</b></h4>
                                <p class="">
                                    <span class=""><b>Phone No:</b> {{$meeting->phoneNo}}</span><br>
                                    <span class=""><b>Place:</b> {{$meeting->address}}</span>
                                </p>
                                <?php
                                $user = \App\Models\User::find($meeting->userId);
                                ?>
                                <p class="card-text">
                                    Created By <span class="text-primary">{{$user->name}}</span> on <b>{!! date('d M y h:i A', strtotime($meeting->created_at)) !!}</b>
                                </p>
                                <p class="card-text">
                                    <a href="#" id="detail" class="btn btn-success btn-sm mx-1" title="Detail" data-toggle="modal" data-target="#detailModal{{$meeting->id}}">View</a>
                                    <a href="{{route('edit-meeting',['id'=>$leed->id, 'mId'=>$meeting->id])}}" class="btn btn-danger btn-sm mx-1">Edit</a>
                                    <a href="{{route('delete-meeting',['id'=>$leed->id, 'mId'=>$meeting->id])}}" class="btn btn-dark btn-sm mx-1">Delete</a>
                                </p>
                            </div>
                            <hr class="mb-0">
                        </div>
                        @include('CRM.successLeeds.modaldetail')
                    @endforeach
                </div>
            </div>
        @endif
    </div>
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
                title: 'New Company Information Added Successfully'
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
@endsection('leedContent')
