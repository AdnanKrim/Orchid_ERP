@extends('master.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span>Add Menu</span>

                        </div>
                        <div class="card-body">

                            <form action="{{route('addMenu')}}" method="POST">
                                @csrf


                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Menu Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Code</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="code" value="{{old('code')}}"/>
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
