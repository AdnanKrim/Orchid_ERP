@extends('CRM.layouts_successLeeds.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <div class="col-sm-12 pb-0 px-0">
              <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                  <a class="navbar-brand" href="#">Client/Company-{{$leed->clientName}}</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                      <ul class="navbar-nav">
                          <li class="nav-item active ml-lg-5">
                              <a class="nav-link" href="{{route('success-leeds-panel',['id'=>$leed->id])}}">Profile</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{route('all-meeting',['id'=>$leed->id])}}">Meetings</a>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Measurements
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{route('all-quotation', ['id'=>$leed->id])}}">Measurements</a>
                                  <a class="dropdown-item" href="{{route('measure-cart', ['id'=>$leed->id])}}">Measurement Cart</a>
                                  <a class="dropdown-item" href="{{route('all-measure-struct', ['id'=>$leed->id])}}">Measurement Structure</a>
                                  <a class="dropdown-item" href="{{route('all-measure-types', ['id'=>$leed->id])}}">Measurement Type</a>
                              </div>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Quotations
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{route('all-quotation', ['id'=>$leed->id])}}">Quotes</a>
                                  <a class="dropdown-item" href="{{route('add-cart',['id'=>$leed->id])}}">House Area Cart</a>
                                  <a class="dropdown-item" href="{{route('all-house-area-type', ['id'=>$leed->id])}}">House Area Type</a>
                                  <a class="dropdown-item" href="{{route('all-decoration-type', ['id'=>$leed->id])}}">Decoration</a>
                                  <a class="dropdown-item" href="{{route('edit-sub-body', ['id'=>$leed->id])}}">Subject & Body</a>
                              </div>
                          </li>
                          <li class="nav-item  ml-lg-2">
                              <a href ="{{ route('designPage',['id'=>$leed->id]) }}" class="nav-link fw-normal fs-1 active" >Design Work</a>
                          </li>
                          <li class="nav-item  ml-lg-2">
                              <a href ="{{ route('allDeed',['id'=>$leed->id]) }}" class="nav-link fw-normal fs-1 active" >Deed</a>
                          </li>
                      </ul>
                  </div>
              </nav>
          </div>
    <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
    {{--          <div class="col-md-3">--}}
    {{--            <!-- Profile Image -->--}}
    {{--            <div class="card card-primary card-outline">--}}
    {{--              <div class="card-body box-profile">--}}
    {{--                <div class="text-center">--}}
    {{--                    <img src="{{asset($leed->logo)}}" alt="" height="150" width="200"/>--}}
    {{--                </div>--}}
    {{--                <h3 class="profile-username text-center mt-4">{{$leed->email}}</h3>--}}

    {{--                <p class="text-muted text-center">Software Engineer</p>--}}
    {{--              </div>--}}
    {{--              <!-- /.card-body -->--}}
    {{--            </div>--}}
    {{--          </div>--}}
              <!-- /.col -->
              @yield('leedContent')
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
      </div>
    <!-- /.content -->

  <!-- /.content-wrapper -->
@endsection
