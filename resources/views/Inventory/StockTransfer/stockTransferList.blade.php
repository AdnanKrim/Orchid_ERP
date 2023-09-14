@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                {{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Stock Transfer List</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="{{route('stockAdjustSearch')}}" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="query" id="deptSearch" onkeyup="myFunction()" placeholder="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="{{route('stockTransfer')}}" class="btn btn-success float-right">+Add</a></span>
                                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Product Name</th>
                                    <th>Business Branch (From)</th>
                                    <th>Business Branch (To)</th>
                                    <th>Transfer Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Shipping Charge</th>
                                    <th>Adjusted By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($stocks as $stock)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$stock->Date}}</td>
                                        <td>
                                            @foreach($products as $product)
                                                @if($product->id === $stock->Product)
                                                    {{$product->productName}}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td>
                                            @foreach($branches as $branch)
                                                @if($branch->id === $stock->From)
                                                    {{$branch->branchName}}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td>
                                            @foreach($branches as $branch)
                                                @if($branch->id === $stock->To)
                                                    {{$branch->branchName}}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td>{{$stock->TransferQuantity}}</td>
                                        <td>{{$stock->TotalAmount}}</td>
                                        <td>{{$stock->ShippingCharge}}</td>

                                        <td>
                                            @foreach($users as $user)
                                                @if($user->id === $stock->TransferredBy)
                                                    {{$user->name}}
                                                @endif
                                            @endforeach

                                        </td>

                                        <td>
                                            <a href="/get-stockTransfer/{{$stock->id}}" class="btn btn-success btn-sm me-1" title="Update">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('stockTransferInfo', $stock->id) }}" >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
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
                    <h5 class="modal-title text-danger">Stock Transfer Delete</h5>
                </div>
                <div class="modal-body">
                    <span class="text-dark">Are you sure to delete this Stock Transfer?</span>
                </div>
                <div class="modal-footer">
                    <form action="{{route('stockTransferDelete')}}" class="form-group" method="post" enctype="multipart/form-data">
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
                title: 'Stock Transferred Successfully'
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
                icon: 'error',
                title: 'Stock Transferred Failed'
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
                title: 'Stock Transferred Information Updated Successfully'
            })
        }

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("deptSearch");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endsection
