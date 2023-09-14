@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-8 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <h4 class="card-header">Supplier Payment Details</h4>

                    <div class="card-body bg-white">
                        <h4 class="text-success">{{Session::get('message')}}</h4>
                        <div class="bg-white">
                            <form action="" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="categorySearch" id="categorySearch" onkeyup="myFunction()" placeholder="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Supplier Name</th>
                                    <th>Owner Name</th>
                                    <th>Mobile No</th>
                                    <th>Email</th>
                                    <th>Due Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($suppliers as $supp)
                                    <?php
                                    $purchases = App\Models\Purchase\purchase::where('supplierId',$supp->id)
                                        ->get();
                                    $dues = 0;
                                    foreach ($purchases as $value){
                                        $dues += $value->due;
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td><a href="{{route('supplier.transaction.list',['id'=>$supp->id])}}">{{$supp->companyOrStoreName}}</a></td>
                                        <td>{{$supp->ownerName}}</td>
                                        <td>{{$supp->phoneNo}}</td>
                                        <td>{{$supp->email}}</td>
                                        <td>{{$dues}}</td>
                                    </tr>
                                @endforeach
                                <?php
                                $purchases = \App\Models\Purchase\purchase::all();
                                $allDues = 0;
                                foreach ($purchases as $value){
                                    $allDues += $value->due;
                                }
                                ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td>{{$allDues}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
