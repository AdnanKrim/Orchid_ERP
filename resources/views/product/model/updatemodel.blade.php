@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Update Model </div>
                            <div class="card-body">

                                <form action="/m-update/{{$user->id}}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Brand Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="brandId">
                                                <option value="">Select a Brand</option>
{{--                                                <option value="{{$showname->brandName}}" selected>{{$showname->brandName}}</option>--}}
                                                @foreach($brands as $brand)
                                                    <option @if($brand->id === $showname->id) selected @endif value="{{$brand->id}}">{{$brand->brandName}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Model Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="modelName" value="{{$user->modelName}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Description</label>
                                        <div class="col-md-8">
                                            <textarea  class="form-control" name="note">{{$user->note}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Update" />
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
