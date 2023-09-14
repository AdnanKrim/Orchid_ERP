@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span>Add New Employee</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('empCreate')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="name">Full Name</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="eg. Mr. X">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="joining">Date of Joining</label>
                                        <input class="form-control" type="date" name="joining" id="joining">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Department</label>
                                        <select class="form-control" name="dept">
                                        <option value="">Select a Department</option>
                                        @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{$department->departmentName}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Designation</label>
                                        <select class="form-control" name="designation">
                                        <option value="">Select a Designation</option>
                                        @foreach ($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->designationName}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="name">Role</label>
                                        <select class="form-control" name="role">
                                        <option value="">Select a Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="name">Gender</label>
                                        <select class="form-control" name="gender">
                                        <option value="">Select a Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="joining">Date of birth</label>
                                        <input class="form-control" type="date" name="dob" id="dob">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="image">Photo</label>
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="tel" name="phone" id="phone"  placeholder="eg. 01xxxxxxxxx">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="otRate">OT Rate (%)</label>
                                        <input class="form-control" type="number" name="otRate" id="otRate" placeholder = "Enter Over time rate">
                                     </div>
                                    <div class="col-md-3">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder = "eg.  yourmail@gmail.com">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="salary">Basic salary</label>
                                        <input class="form-control" type="number" name="salary" id="salary" placeholder = "Enter Amount of salary">
                                    </div>
                                </div>
                                <div class="form-group row">

                                <div class="col-md-3">
                                        <label for="shiftName">Shift</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="shiftName" id="shiftName" data-live-search="true">
                                                <option value="">Select an Shift</option>
                                                @foreach($shifts as $shift)
                                                <option value="{{$shift->shiftName}}">{{$shift->shiftName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                        <label for="offDay">Off day</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="offDay[]" id="offDay[]" multiple data-live-search="true">
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                        <label for="status">Status</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="status" id="status" data-live-search="true">
                                                <option value="">Select an Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="Add"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection
