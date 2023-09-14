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
                            <div class="card-header">Add Product </div>
                            <div class="card-body">

                                <form action="addProduct" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Product Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="productName" />
                                            <span style="color:red;">@error('productName'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Product Code</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="productCode" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">SKU</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="SKU" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Category Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="categoryId" >
                                                <option value="">select Category</option>
                                                @foreach($cats as $cat)
                                                    <option value="{{$cat->id}}" >{{$cat->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Sub Catagory Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="subCategoryId" >
                                                <option value="" >select Sub Category</option>
                                                @foreach($scats as $scat)
                                                    <option value="{{$scat->id}}" >{{$scat->subCategoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Unit Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="unitId" >
                                                <option value="" >select Unit</option>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->id}}" >{{$unit->uniteName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Brand Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="brandId" >
                                                <option value="">select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" >{{$brand->brandName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Model Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="modelId" >
                                                <option value="">select Model</option>
                                                @foreach($mods as $mod)
                                                    <option value="{{$mod->id}}" >{{$mod->modelName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Size Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="sizeId" >
                                                <option value="">select Size</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{$size->id}}">{{$size->sizeName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Color Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="colorId" >
                                                <option value="">select Color</option>
                                                @foreach($clrs as $clr)
                                                    <option value="{{$clr->id}}">{{$clr->colorName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Length</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="length" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Height</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="height" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Width</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="width" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Business Branch Name</label>
                                        <div class="col-md-8 input-group">
                                            {{--                                            <span class="input-group-text bg-white"><i class="fa-solid " style="color:#4666ff"></i> </span>--}}
                                            <select id="state" class="form-control select2 bg-white" name="businessBranchId" >
                                                <option value="">select Branch</option>
                                                @foreach($branchs as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->companyName}}</option>
                                                @endforeach
                                            </select>
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
