@extends('master.app')
@section('content')
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="col-lg-12 bg-white mx-auto mt-5">
            <div class="card bg-white">
            <h4 class="card-header">All Expense</h4>

                <div class="card-body bg-white">
                    <h4 class="text-success">{{Session::get('message')}}</h4>
                    <div class="bg-white">
                        <form action="" method="GET">
                            <div class="form-group row">
                                <label class="col-md-6">
                                    <input type="text" class="form-control bg-white" name="categorySearch" id="categorySearch" onkeyup="myFunction()" placeholder="Search"/>
                                </label>
                                <div class="col-md-6 ml-0">
                                    <span class="float-right col-md-6"><a href="{{route('add.exp')}}" class="btn btn-success float-right">+Add</a></span>

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
                                <th>Expense Category</th>
                                <th>Business Branch</th>
                                <th>Payment Status</th>
                                <th>Amount (Taka)</th>
                                <th>payment Due</th>
                                <th>Expense For</th>
                                <th>Under Client</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($expenses as $value)
                                <?php
                                    $expCategories = \App\Models\Expense\ExpCategory::where('id',$value->expCategoryId)->get();
                                    $branches = \App\Models\Settings\CompanyInfo::where('id',$value->branchId)->get();
                                    $Leeds = \App\Models\CRM\Leeds::where('id',$value->clientId)->get();
                                ?>
                                @foreach($expCategories as $ec)
                                    @foreach($branches as $b)
                                    @foreach($Leeds as $l)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$value->date}}</td>
                                    <td>{{$ec->name}}</td>
                                    <td>{{$b->companyName}}</td>
                                    <td class="text-bold {{$value->paymentStatus==='Paid'?'text-success':''}}{{$value->paymentStatus==='Unpaid'?'text-danger':''}}{{$value->paymentStatus=='Partial'?'text-warning':''}}">{{$value->paymentStatus}}</td>
                                    <td>{{$value->expAmount}}</td>
                                    <td>{{$value->due}}</td>
                                    <td>{{$value->for}}</td>
                                    <td>{{$l->clientName}}</td>
                                    <td>
                                        <a href="{{route('edit.exp',['id'=>$value->id])}}" class="btn btn-success btn-sm me-1" title="Update">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm mx-1" onclick="deleteExp({{$value->id}})">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form method="POST" action="{{route('delete.exp',['id'=>$value->id])}}" id="deleteExpForm{{$value->id}}">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
    <script>
        function deleteExp(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteExpForm'+id).submit();
            }
        }
    </script>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("categorySearch");
            filter = input.value.toUpperCase();
             table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                 td = tr[i].getElementsByTagName("td")[6];
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
</div>
@endsection
