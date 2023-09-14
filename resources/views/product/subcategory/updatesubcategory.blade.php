@extends('master.app')
@section('content')
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Update Sub Category</div>
                            <div class="card-body">
                                <form action="/s-update/{{$user->id}}" method="POST">
                                    @csrf
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-md-4 col-form-label">Catagory Name</label>--}}
{{--                                        <div class="col-md-8 input-group">--}}

{{--                                            <select  class="form-control bg-white" name="categoryId" value="{{$showname->categoryName}}" >--}}
{{--                                                <option  selected>{{$showname->categoryName}}</option>--}}
{{--                                                @foreach($cats as $cat)value="{{$showname->categoryName}}"--}}
{{--                                                    <option value="{{$cat->id}}" selected>{{$cat->categoryName}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Catagory Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="categoryId">
                                                <option value="">Select a Category</option>
{{--                                                <option value="{{$showname->categoryName}}" selected>{{$showname->categoryName}}</option>--}}
                                                @foreach($cats as $cat)
                                                    <option @if($cat->id === $showname->id) selected @endif value="{{$cat->id}}">{{$cat->categoryName}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Sub Category Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="subCategoryName" value="{{$user['subCategoryName']}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"> Sub Category Code</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="subCategoryCode" value="{{$user['subCategoryCode']}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Description</label>
                                        <div class="col-md-8">
                                            <textarea  class="form-control" name="note">{{$user['note']}}</textarea>
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
