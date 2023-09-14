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
                            <span>Update Submenu</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('SubSubmenuEditSubmit')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" class="form-control" name="id" value="{{$subsubmenu->id}}"/>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Sub-Sub-Menu</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="submenu">
                                        <option value="">Select a SubMenu</option>
                                        @foreach ($submenus as $submenu)
                                        <option @if($submenu->id === $submenuName->id) selected @endif value="{{$submenu->submenuName}}">{{$submenu->subMenuName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Sub-Submenu Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="sub_subMenuName" value="{{$subsubmenu->sub_subMenuName}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Code</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="code" value="{{$subsubmenu->code}}"/>
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
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection
