@extends('master.app')
@section('content')
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">

                            <div class="card-header">Update Product Category </div>
                            <div class="card-body">
                                <form action="/update/{{$data['id']}}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" name="id" value="{{$data['id']}}" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Category Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="categoryName" value="{{$data['categoryName']}}"  />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Category Code</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="categoryCode" value="{{$data['categoryCode']}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Description</label>
                                        <div class="col-md-8">
                                            <textarea  class="form-control" name="note">{{$data['note']}}</textarea>
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

@endsection
