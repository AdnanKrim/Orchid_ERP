@extends('master.app')
@section('content')
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="col-lg-8 bg-white mx-auto mt-5">
            <div class="card bg-white">
            <h4 class="card-header">All Transfer</h4>

                <div class="card-body bg-white">
                    <h4 class="text-success">{{Session::get('message')}}</h4>
                    <div class="bg-white">
                        <form action="" method="GET">
                            <div class="form-group row">
                                <label class="col-md-6">
                                    <input type="text" class="form-control bg-white" name="categorySearch" id="categorySearch" onkeyup="myFunction()" placeholder="Search"/>
                                </label>
                                <div class="col-md-6 ml-0">
                                    <span class="float-right col-md-6"><a href="{{route('add.transfer')}}" class="btn btn-success float-right">+Add</a></span>

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
                                <th>Transfer From</th>
                                <th>Transfer To</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transfers as $value)
                                <?php
                                    $accFrom = \App\Models\Account\Account::where('id',$value->transferFromId)->first();
                                    $accTo = \App\Models\Account\Account::where('id',$value->transferToId)->first();
                                ?>
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$value->date}}</td>
                                    <td>{{$accFrom->accName}}-{{$accFrom->accNo}}</td>
                                    <td>{{$accTo->accName}}-{{$accTo->accNo}}</td>
                                    <td>{{$value->amount}}</td>
                                    <td>
                                        <a href="{{route('edit.exp',['id'=>$value->id])}}" class="btn btn-success btn-sm me-1" title="Update">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm mx-1" onclick="deleteCategory({{$value->id}})">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form method="POST" action="{{route('delete.exp',['id'=>$value->id])}}" id="deleteCategoryForm{{$value->id}}">
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
    </div>
    <script>
        function deleteCategory(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteCategoryForm'+id).submit();
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
                 td = tr[i].getElementsByTagName("td")[0];
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
