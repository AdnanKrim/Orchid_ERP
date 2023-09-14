@extends('master.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">Update Project Category</div>
                        <div class="card-body">
                            <form action="{{route('updateCategory')}}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" name="id" value="{{$category->id}}"/>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Project Category Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="projectCategoryName" value="{{$category->projectCategoryName}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Project Category Code</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="projectCategoryCode" value="{{$category->projectCategoryCode}}"/>
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
