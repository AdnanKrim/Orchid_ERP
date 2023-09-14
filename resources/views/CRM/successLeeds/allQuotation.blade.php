@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">All Quotations</h4>

            <div class="card-body bg-white">
{{--                <h4 class="text-success">{{Session::get('message')}}</h4>--}}
                <div class="bg-white">
                    <form action="" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-6">
                                <input type="text" class="form-control bg-white" name="searchType" value="Search"/>
                            </label>
                            <div class="col-md-6 ml-0">
{{--                                <span class="float-right col-md-6"><a href="{{route('add-quotation', ['id'=>$leed->id])}}" class="btn btn-success float-right">+Add</a></span>--}}
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
                            <th>Subject</th>
                            <th>Body</th>
                            <th>Total Amount</th>
                            <th>Total Vat</th>
                            <th>Grand Total</th>
                            <th>Note</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($quotations as $quotation)


                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$quotation->subject}}</td>
                                <td>{{$quotation->body}}</td>
                                <td>{{$quotation->totalAmount}}</td>
                                <td>{{$quotation->totalVat}}</td>
                                <td>{{$quotation->grandTotal}}</td>
                                <td>{{$quotation->note}}</td>
                                <td>
                                    <a href="{{route('edit-decoration-type', ['id'=>$leed->id,'decor'=>$quotation->id])}}" class="btn btn-success btn-sm mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="deleteQ({{$quotation->id}})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form method="POST" action="{{route('delete-quotation', ['id'=>$leed->id,'qId'=>$quotation->id])}}" id="deleteQForm{{$quotation->id}}">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteQ(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteQForm'+id).submit();
            }
        }
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
                title: 'New Company Information Added Successfully'
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
                title: 'Company Information Deleted Successfully'
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
                title: 'Company Information Updated Successfully'
            })
        }
    </script>
@endsection


