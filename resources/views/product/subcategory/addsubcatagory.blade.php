
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
                            <div class="card-header">Add Sub Category </div>
                            <div class="card-body">

                                <form action="addscategory" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Catagory Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8 input-group">
{{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="categoryId" >
                                                <option value="" selected>select Category</option>
                                                @foreach($user as $select)
                                                <option value="{{$select->id}}" >{{$select->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span style="color:red; margin-left: 15rem;">@error('categoryId'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Sub Category Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="subCategoryName" />
                                            <span style="color:red;">@error('subCategoryName'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"> Sub Category Code</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="subCategoryCode" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Description</label>
                                        <div class="col-md-8">
                                            <textarea  class="form-control" name="note"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Add" />
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
