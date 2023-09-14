@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Update Product </div>
                            <div class="card-body">
                                <form action="/p-update/{{$user->id}}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" name="id" value="{{$user->id}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Product Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="productName" value="{{$user->productName}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Product Code</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="productCode" value="{{$user->productCode}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">SKU</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="SKU" value="{{$user->SKU}}"  />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Category Name</label>
                                        <div class="col-md-8">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="categoryId">
                                                <option value="">Select a Category</option>
                                                @foreach($cats as $cat)
                                                    <option @if($cat->id === $showcat->id) selected @endif value="{{$cat->id}}" >{{$cat->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Sub Catagory Name</label>
                                        <div class="col-md-8">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="subCategoryId">
                                                <option value="">Select a Sub Category</option>
{{--                                                <option value="{{$showscat->subCategoryName}}" selected>{{$showscat->subCategoryName}}</option>--}}
                                                @foreach($scats as $scat)
                                                    <option @if($scat->id === $showscat->id) selected @endif value="{{$scat->id}}" >{{$scat->subCategoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Unit Name</label>
                                        <div class="col-md-8">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="unitId">
                                                <option value="" >Select a Unit</option>
{{--                                                <option value="{{$showunit->uniteName}}" selected>{{$showunit->uniteName}}</option>--}}
                                                @foreach($units as $unit)
                                                    <option @if($unit->id === $showunit->id) selected @endif value="{{$unit->id}}" >{{$unit->uniteName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Brand Name</label>
                                        <div class="col-md-8 ">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="brandId">

                                                <option value="" >Select a Brand</option>
{{--                                                <option value="{{$showbrand->brandName}}" selected>{{$showbrand->brandName}}</option>--}}
                                                @foreach($brands as $brand)
                                                    <option @if($brand->id === $showbrand->id) selected @endif value="{{$brand->id}}" >{{$brand->brandName}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Model Name</label>
                                        <div class="col-md-8">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="modelId">
                                                <option value="">Select a Model</option>
{{--                                                <option value="{{$showmod->modelName}}" selected>{{$showmod->modelName}}</option>--}}
                                                @foreach($mods as $mod)
                                                    <option   @if($mod->id === $showmod->id ) selected @endif value="{{$mod->id}}" >{{$mod->modelName}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Size Name</label>
                                        <div class="col-md-8">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="sizeId">
                                                <option value="" >Select a Size</option>
{{--                                                <option value="{{$showsize->sizeName}}" selected>{{$showsize->sizeName}}</option>--}}
                                                @foreach($sizes as $size)
                                                    <option @if($size->id === $showsize->id) selected @endif value="{{$size->id}}">{{$size->sizeName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Color Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="colorId">
                                                <option value="" >Select a Color</option>
{{--                                                <option value="{{$showclr->colorName}}" selected>{{$showclr->colorName}}</option>--}}
                                                @foreach($clrs as $clr)
                                                    <option @if($clr->id === $showclr->id) selected @endif value="{{$clr->id}}">{{$clr->colorName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Length</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="length" value="{{$user->length}}"  />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Height</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="height" value="{{$user->height}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Width</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="width" value="{{$user->width}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Business Branch Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select class="form-control" name="businessBranchId">
                                                <option value="" >Select a Branch</option>
{{--                                                <option value="{{$showbranch->companyName}}" selected>{{$showbranch->companyName}}</option>--}}
                                                @foreach($branchs as $branch)
                                                    <option @if($branch->id === $showbranch->id) selected @endif value="{{$branch->id}}">{{$branch->companyName}}</option>
                                                @endforeach
                                            </select>
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
