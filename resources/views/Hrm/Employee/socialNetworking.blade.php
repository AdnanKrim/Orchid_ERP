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
                        <a href="/Employee-social/{{$user->id}}" class="nav-link px-0 align-middle active p-2">
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
                        <a href="/Employee-bank/{{$user->id}}" class="nav-link px-0 align-middle">
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
            <h4 class="card-header">Social Networking</h4>
                <div class="card-body bg-white">
                <form action="{{route('socialNetworkPost')}}" class="form-group" method="POST" enctype="multipart/form-data">
                <input class="form-control" type="hidden" name="id" id="id" value="{{$user->id}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="fbprofile">Facebook Profile</label>
                                        <input class="form-control" type="text" name="fbprofile" id="fbprofile" placeholder="Facebook Profile" value="@if(!empty($sn->facebookProfile)) {{$sn->facebookProfile}} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="twitterProfile">Twitter Profile</label>
                                        <input class="form-control" type="text" name="twitterProfile" id="twitterProfile" placeholder="Twitter Profile" value="@if(!empty($sn->facebookProfile)) {{$sn->twitterProfile}} @endif">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="bloggerProfile">Blogger Profile</label>
                                        <input class="form-control" type="text" name="bloggerProfile" id="bloggerProfile" placeholder="Blogger Profile" value="@if(!empty($sn->bloggerProfile)) {{$sn->bloggerProfile}} @endif">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="linkedinprofile">Linkedin Profile</label>
                                        <input class="form-control" type="text" name="linkedinprofile" id="linkedinprofile" placeholder="Linkedin Profile" value="@if(!empty($sn->linkedinProfile)) {{$sn->linkedinProfile}} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="googleProfile">Google Plus Profile</label>
                                        <input class="form-control" type="text" name="googleProfile" id="googleProfile" placeholder="Google Plus Profile" value="@if(!empty($sn->googlePlusProfile)) {{$sn->googlePlusProfile}} @endif">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="intagramprofile">Instagram Profile</label>
                                        <input class="form-control" type="text" name="intagramprofile" id="intagramprofile" placeholder="Instagram Profile" value="@if(!empty($sn->instagramProfile)) {{$sn->instagramProfile}} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="PinterestProfile">PinterestProfile Profile</label>
                                        <input class="form-control" type="text" name="PinterestProfile" id="PinterestProfile" placeholder="Pinterest Profile" value="@if(!empty($sn->pinterestProfile)) {{$sn->pinterestProfile}} @endif">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="youtubeProfile">Youtube Profile</label>
                                        <input class="form-control" type="text" name="youtubeProfile" id="youtubeProfile" placeholder="Youtube Profile" value="@if(!empty($sn->youtubeProfile)) {{$sn->youtubeProfile}} @endif">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="@if(!empty($sn->EmployeeId)) Update @else Save @endif"/>
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
                title: 'Social Network Information Created Successfully'
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
                title: 'Social Network Information Deleted Successfully'
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
                title: 'Social Network Information Updated Successfully'
            })
        }

    </script>

@endsection
