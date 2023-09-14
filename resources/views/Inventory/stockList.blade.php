@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                {{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">All Stocks</h4>

                    <div class="card-body bg-white">

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Product Name</th>
                                    <th >Stock In Hand</th>
                                    <th >Average Cost</th>
                                    <th >Stock Purchase Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($stocks as $stock)
                                    <?php
                                        $product = \App\Models\Product\Product::where('id', $stock->productId)->first();
                                    ?>
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$product->productName}}</td>
                                        <td>{{$stock->stockInHand}}</td>
                                        <td>{{$stock->average}}</td>
                                        <td>{{$stock->stockPurchaseValue}}</td>
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
{{--    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title text-danger">Brand Delete</h5>--}}

{{--                </div>--}}
{{--                <div class="modal-body">--}}

{{--                    <span class="text-dark">Are you sure to delete this Brand?</span>--}}

{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <form action="{{ route('deleteBrand') }}" class="form-group" method="post" enctype="multipart/form-data">--}}
{{--                        {{csrf_field()}}--}}
{{--                        <input type="hidden" id="user-id" name="id">--}}
{{--                        <input type="submit" class="btn btn-danger" id="yes" value="Yes">--}}
{{--                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--        //-----------cancel ride-----------------}}
{{--        $(document).ready(function () {--}}

{{--            $('body').on('click', '#delete', function () {--}}
{{--                var userURL = $(this).data('url');--}}
{{--                $.get(userURL, function (data) {--}}
{{--                    $('#deleteModal').modal('show');--}}
{{--                    $('#user-id').val(data.id);--}}

{{--                })--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        function create()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'New Brand Created Successfully'
            })
        }
        function wise_words()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Brand Deleted Successfully'
            })
        }
        function update()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Brand Updated Successfully'
            })
        }
    </script>
@endsection
