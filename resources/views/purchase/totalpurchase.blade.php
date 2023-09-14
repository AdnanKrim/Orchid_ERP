@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                {{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Total Purchase List</h4>

                    <div class="card-body bg-white">

                        <div class="bg-white">
                            <form action="/purchase-search" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="query" value="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="/create-purchase" class="btn btn-success float-right">+Add</a></span>
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
                                    <th >Date</th>
                                    <th>Purchase Bill No</th>
                                    <th >Supplier Name</th>
                                    <th >Client Name</th>
                                    <th >Business Branch</th>
                                    <th >Payment Status</th>
                                    <th >Grand Total</th>
                                    <th >Payment Due</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($purchases as $purchase)
                                    <?php
                                        if (!is_null($purchase->branch)){
                                            $company = \App\Models\Settings\CompanyInfo::where('id','=',$purchase->branch)->first();
                                        }

                                    ?>
                                    <?php
                                    $products = json_decode($purchase['products']);
//                                    $pdt = \App\Models\User::where('id','=', $purchase->userId)->first();
                                    $client =\App\Models\CRM\Leeds::where('id','=',$purchase->clientId)->first();
                                    if($purchase->clientId === null){
                                        $client = \App\Models\CRM\Leeds::all('clientName')->first();
                                    }
                                    $supp = \App\Models\Supplier\Supplier::where('id','=',$purchase->supplierId)->first();
                                    if($purchase->supplierId === null){
                                        $supp = \App\Models\Supplier\Supplier::all('companyOrStoreName')->first();
                                    }



//                                    if($purchase->branch != null){
////                                        $company = \App\Models\Settings\CompanyInfo::all()->first();
//                                        $company = \App\Models\Settings\CompanyInfo::where('id','=',$purchase->branch)->first();
//                                    }
                                    ?>
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$purchase->date}}</td>
                                        <td>{{$purchase->purchaseId}}</td>
                                        <td>{{$supp->companyOrStoreName}}</td>
                                        <td>{{$client->clientName}}</td>

                                        <td><?php if (!is_null($purchase->branch)) {echo $company->companyName;}; ?></td>
                                        <td>{{$purchase->paymentStatus}}</td>
                                        <td>{{$purchase->grandTotal}}</td>
                                        <td>{{$purchase->due}}</td>

{{--                                        <td>--}}
{{--                                            @foreach($products as $product)--}}
{{--                                                <?php--}}
{{--                                                $good = \App\Models\Product\Product::where('id','=',$product->productId)->first();--}}
{{--                                                if($product->productId === null){--}}
{{--                                                    $good = \App\Models\Product\Product::all('productName')->first();--}}
{{--                                                }--}}
{{--                                                ?>--}}
{{--                                                {{$good->productName}},--}}
{{--                                            @endforeach--}}
{{--                                        </td>--}}

                                        <td>
{{--                                            <a href="/edit/{{$purchase['id']}}" class="btn btn-success btn-sm" title="Update">--}}
{{--                                                <i class="fa fa-edit"></i>--}}
{{--                                            </a>--}}
                                            <a href="#" id="detail" class="btn btn-primary btn-sm"  title="Detail" data-toggle="modal" data-target="#detailModal{{$purchase->id}}">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('purchaseInfo', $purchase->id) }}" >
                                                <i class="fa fa-trash"></i>
                                            </a> <br>
                                            <a href="/return-purchase/{{$purchase->id}}" style="margin-top: 1rem;" class="btn btn-primary btn-sm" title="Update">
                                                Return
                                            </a>

                                        </td>
                                        @include('purchase.modalpurchase')
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
                    <h5 class="modal-title text-danger">Purchase Delete</h5>

                </div>
                <div class="modal-body">

                        <span class="text-dark">Are you sure to delete this Purchase?</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('deletePurchase') }}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="user-id" name="id">
                    <input type="submit" class="btn btn-danger" id="yes" value="Yes">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
{{--                title: 'New Purchase Created Successfully'--}}
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
{{--                title: 'Purchase Deleted Successfully'--}}
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
{{--                title: 'Purchase Updated Successfully'--}}
{{--            })--}}
{{--        }--}}
{{--    </script>--}}

@endsection
