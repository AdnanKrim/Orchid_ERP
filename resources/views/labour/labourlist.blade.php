@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">Labour List</h4>

                    <div class="card-body bg-white">

                        <div class="bg-white">
                            <form action="/labour-search" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="query" value="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="/add-labour-bill" class="btn btn-success float-right">+Add</a></span>
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
                                    <th >Labour Bill No.</th>
                                    <th >Labour Name</th>
                                    <th >Labour Type</th>
                                    <th >Project Name</th>
                                    <th >Payment</th>
                                    <th >Labour Bill Due</th>
                                    <th >Total Bill Amount</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($labours as $labour)
                          <?php
                          $client =\App\Models\CRM\Leeds::where('id','=', $labour->clientId)->first();
                          $labourName = \App\Models\Labour\Labourname::where('id','=',$labour->labourNameId)->first();
                          $labourType = \App\Models\Labour\Labourtype::where('id','=',$labour->labourTypeId)->first();
                          ?>
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$labour->date}}</td>
                                        <td>{{$labour->labourId}}</td>
                                        <td>{{$labourName->labourName}}</td>
                                        <td>{{$labourType->labourTypeName}}</td>
                                        <td></td>
                                        <td>{{$labour->paid}}</td>
                                        <td>{{$labour->due}}</td>
                                        <td>{{$labour->finalTotal}}</td>



                                        <td>

                                            <div class="dropdown show">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('LabourBillInfo', $labour->id) }}" >
                                                        <i class="fa fa-trash">  Delete</i>
                                                    </a> <br> <br>
                                                    <a href="#" id="detail" class="btn btn-primary btn-sm"  title="Detail" data-toggle="modal" data-target="#detailModal{{$labour->id}}">
                                                        <i class="fa fa-eye">  View</i>
                                                    </a><br> <br>
                                                    <a  class="btn btn-success btn-sm" id="payment" title="payment" href=""  >
                                                        <i class="fa fa-dollar">  Payment</i>
                                                    </a> <br> <br>
                                                    <a  class="btn btn-info btn-sm" id="return" title="return" href=""  >
                                                        <i class="fa fa-rocket">  Return</i>
                                                    </a> <br> <br>

{{--                                                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                                                    <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                                    <a class="dropdown-item" href="#">Something else here</a>--}}
                                                </div>
                                            </div>
                                        </td>
                                        @include('labour.modallabourbill')
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
                    <h5 class="modal-title text-danger">Labour Bill Delete</h5>

                </div>
                <div class="modal-body">

                    <span class="text-dark">Are you sure to delete this LabourBill?</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('deleteLabourBill') }}" class="form-group" method="post" enctype="multipart/form-data">
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
{{--                title: 'New LabourBill Created Successfully'--}}
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
{{--                title: 'LabourBill Deleted Successfully'--}}
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
{{--                title: 'LabourBill Updated Successfully'--}}
{{--            })--}}
{{--        }--}}
{{--    </script>--}}

@endsection
