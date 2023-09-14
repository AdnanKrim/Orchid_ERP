@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">All Products</h4>

                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="/product-search" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="query" value="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="/add-product" class="btn btn-success float-right">+Add</a></span>
                                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Product Name</th>
{{--                                    <th>Product Code</th>--}}
                                    <th>SKU</th>
                                    <th>Category</th>
{{--                                    <th>Sub Category Name</th>--}}
{{--                                    <th>Unit Name</th>--}}
                                    <th>Brand </th>
                                    <th>Model </th>
                                    <th>Size </th>
{{--                                    <th>Color Name</th>--}}
{{--                                    <th>Length</th>--}}
{{--                                    <th>Height</th>--}}
{{--                                    <th>Width</th>--}}
{{--                                    <th>Business Branch</th>--}}
{{--                                    <th>Description</th>--}}
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)

                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$product->productName}}</td>
{{--                                        <td>{{$product->productCode}}</td>--}}
                                        <td>{{$product->SKU}}</td>
                                        <td>{{$product->categoryId}}</td>
{{--                                        <td>{{$product->subCategoryId}}</td>--}}
{{--                                        <td>{{$product->unitId}}</td>--}}
                                        <td>{{$product->brandId}}</td>
                                        <td>{{$product->modelId}}</td>
                                        <td>{{$product->sizeId}}</td>
{{--                                        <td>{{$product->colorId}}</td>--}}
{{--                                        <td>{{$product->length}}</td>--}}
{{--                                        <td>{{$product->height}}</td>--}}
{{--                                        <td>{{$product->width}}</td>--}}
{{--                                        <td>{{$product->businessBranchId}}</td>--}}
{{--                                        <td>{{$product->note}}</td>--}}
                                        <td>
                                            <a href="/p-edit/{{$product->id}}" class="btn btn-success btn-sm" title="Update">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" id="detail" class="btn btn-primary btn-sm"  title="Detail" data-toggle="modal" data-target="#detailModal{{$product->id}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('ProductInfo', $product->id) }}" >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        @include('product.modaldetail')
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Product Delete</h5>

                </div>
                <div class="modal-body">

                        <span class="text-dark">Are you sure to delete this product?</span>

                </div>
                <div class="modal-footer">
                            <form action="{{ route('deleteProduct') }}" class="form-group" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" id="user-id" name="id">
                            <input type="submit" class="btn btn-danger" id="yes" value="Yes">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>
                            </form>
                </div>

            </div>
        </div>
    </div>
{{--    End delete Modal--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        //-----------cancel ride---------------
        $(document).ready(function () {

            $('body').on('click', '#delete', function () {
                var userURL = $(this).data('url');
                $.get(userURL, function (data) {
                    $('#deleteModal').modal('show');
                    $('#user-id').val(data.id);

                })
            });
        });
    </script>
{{--    <script>--}}
{{--        function create()--}}
{{--        {--}}
{{--            var Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 9000--}}
{{--            });--}}
{{--            event.preventDefault();--}}
{{--            Toast.fire({--}}
{{--                icon: 'success',--}}
{{--                title: 'New Product Created Successfully'--}}
{{--            })--}}
{{--        }--}}
{{--        function wise_words()--}}
{{--        {--}}
{{--            var Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 9000--}}
{{--            });--}}
{{--            event.preventDefault();--}}
{{--            Toast.fire({--}}
{{--                icon: 'success',--}}
{{--                title: 'Product Deleted Successfully'--}}
{{--            })--}}
{{--        }--}}
{{--        function update()--}}
{{--        {--}}
{{--            var Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 9000--}}
{{--            });--}}
{{--            event.preventDefault();--}}
{{--            Toast.fire({--}}
{{--                icon: 'success',--}}
{{--                title: 'Product Updated Successfully'--}}
{{--            })--}}
{{--        }--}}
{{--    </script>--}}


@endsection
