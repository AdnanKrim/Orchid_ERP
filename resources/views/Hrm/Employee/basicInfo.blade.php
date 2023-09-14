@extends('master.app')
@section('content')
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
                        <a href="/Employee-Info/{{$user->id}}" class="nav-link align-middle px-0 active p-2">
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
                        <a href="/Employee-experience/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-hourglass-split"></i> <span class="ms-1 d-none d-sm-inline">Work Experience</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-bank/{{$user->id}}" class="nav-link px-0 align-middle ">
                        <i class="bi bi-laptop-fill"></i> <span class="ms-1 d-none d-sm-inline">Bank Account</span> </a>
                    </li>
                    <li>
                        <a href="/Employee-contract/{{$user->id}}" class="nav-link px-0 align-middle">
                        <i class="bi bi-pen-fill"></i> <span class="ms-1 d-none d-sm-inline">Contact</span> </a>
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
            <h4 class="card-header">Basic Information</h4>
                <div class="card-body bg-white">
                <form action="{{route('updateEmployee')}}" class="form-group" method="POST" enctype="multipart/form-data">
                <input class="form-control" type="hidden" name="id" id="id" value="{{$user->id}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="name">Full Name</label>
                                        <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="joining">Date of Joining</label>
                                        <input class="form-control" type="date" name="joining" id="joining" value="@if(!empty($user->dateOfJoining)){{$user->dateOfJoining}}@endif">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Department</label>
                                        <select class="form-control" name="dept">
                                        <option value="">Select a Department</option>
                                        @foreach($departments as $department)
                                        <option @if($department->id === $departmentName->id) selected @endif value="{{$department->id}}">{{$department->departmentName}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Designation</label>
                                        <select class="form-control" name="designation">
                                        <option value="">Select a Designation</option>
                                        @foreach($designations as $designation)
                                        <option @if($designation->id === $designationName->id) selected @endif value="{{$designation->id}}">{{$designation->designationName}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="name">Role</label>
                                        <select class="form-control" name="role">
                                        <option value="">Select a Role</option>
                                        @foreach($roles as $role)
                                        <option @if($role->id === $roleName->id) selected @endif value="{{$role->id}}">{{$role->role}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="name">Gender</label>
                                        <select class="form-control" name="gender">
                                        <option value="">Select a Gender</option>
                                        <option @if($user->gender === "Male") selected @endif value="Male">Male</option>
                                        <option @if($user->gender === "Female") selected @endif value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="joining">Date of birth</label>
                                        <input class="form-control" type="date" name="dob" id="dob" value="{{$user->dateOfBarth}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="tel" name="phone" id="phone" value="{{$user->phone}}">
                                    </div>
                                </div>
                                <div class="form-group row">

                                <div class="col-md-3">
                                        <label for="otRate">OT Rate (%)</label>
                                        <input class="form-control" type="number" name="otRate" id="otRate" placeholder = "Enter Over time rate" value="{{$user->otRate}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="salary">Basic salary</label>
                                        <input class="form-control" type="number" name="salary" id="salary" placeholder = "Enter Amount of salary" value="{{$user->BasicSalary}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                    <label for="shiftName">Shift</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="shiftName" id="shiftName" data-live-search="true">
                                                <option value="">Select an Shift</option>
                                                @foreach($shifts as $shift)
                                                <option @if($shift->shiftName === $shiftName->shiftName) selected @endif value="{{$shift->shiftName}}">{{$shift->shiftName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="offDay">Off day</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="offDay[]" id="offDay[]" multiple data-live-search="true">
                                                <option @foreach($offDays as $offDay) @if($offDay === "Saturday") selected @endif @endforeach value="Saturday">Saturday</option>
                                                <option @foreach($offDays as $offDay) @if($offDay === "Sunday") selected @endif @endforeach value="Sunday">Sunday</option>
                                                <option @foreach($offDays as $offDay) @if($offDay === "Monday") selected @endif @endforeach value="Monday">Monday</option>
                                                <option @foreach($offDays as $offDay) @if($offDay === "Tuesday") selected @endif @endforeach value="Tuesday">Tuesday</option>
                                                <option @foreach($offDays as $offDay) @if($offDay === "Wednesday") selected @endif @endforeach value="Wednesday">Wednesday</option>
                                                <option @foreach($offDays as $offDay) @if($offDay === "Thursday") selected @endif @endforeach value="Thursday">Thursday</option>
                                                <option @foreach($offDays as $offDay) @if($offDay === "Friday") selected @endif @endforeach value="Friday">Friday</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                        <label for="status">Status</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="status" id="status" data-live-search="true">
                                                <option value="">Select an Shift</option>
                                                <option @if($user->Status === 1) selected @endif value="1">Active</option>
                                                <option @if($user->Status === 0) selected @endif value="0">Inactive</option>
                                            </select>
                                        </div>
                                </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="Update"/>
                                    </div>
                                </div>
                            </form>
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

@endsection
