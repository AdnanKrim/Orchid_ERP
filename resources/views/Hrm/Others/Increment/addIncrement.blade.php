@extends('master.app')
@section('content')
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <span>Add Increment</span>
                    </div>
                    <div class="card-body">
                        <form action="{{route('addIncrementPost')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="employee">Employee</label>
                                    <div class="input-group search_select_box">
                                        <select class="form-control" name="employee" id="employee" data-live-search="true" onchange="UserSearch(this.value)">
                                            <option value="">Choose an Employee</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="beforeSalary">Before Salary</label>
                                    <input class="form-control" type="number" name="beforeSalary" id="beforeSalary" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="incrementAmount">Increment Amount</label>
                                    <input class="form-control" type="number" name="incrementAmount" id="incrementAmount" onkeyup="salaryCalculate()">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="presentSalary">Present Salary</label>
                                    <input class="form-control" type="number" name="presentSalary" id="presentSalary" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="effectiveDate">Effective Date</label>
                                    <input class="form-control" type="date" name="effectiveDate" id="effectiveDate">
                                </div>
                                <div class="col-md-4">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" name="note" id="note"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" class="btn btn-success" id="submit" value="Save"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    <script>
        function UserSearch(user){
            if(user !== "") {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function () {
                    let resp = JSON.parse(this.response)
                    console.log(resp)
                    if(resp.BasicSalary !== null) {
                        document.getElementById('beforeSalary').value = resp.BasicSalary;
                        document.getElementById('incrementAmount').value = 0;
                        document.getElementById('presentSalary').value = 0;
                    }
                    else {
                        document.getElementById('beforeSalary').value = 0;
                        document.getElementById('incrementAmount').value = 0;
                        document.getElementById('presentSalary').value = 0;
                    }
                }
                xhttp.open("GET", "/api/user-search?id=" + user);
                xhttp.send();
            }
            else{
                document.getElementById('beforeSalary').value = 0;
                document.getElementById('incrementAmount').value = 0;
                document.getElementById('presentSalary').value = 0;
            }
        }
        function salaryCalculate(){
            let employee = document.getElementById('employee').value;
            let incrementAmount = parseInt(document.getElementById('incrementAmount').value);
            if(employee!==""){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function (){
                    let resp = JSON.parse(this.response)
                    console.log(resp)
                    if(resp.BasicSalary !== null) {
                        let count = 0;
                        count = incrementAmount + parseInt(resp.BasicSalary);
                        document.getElementById('presentSalary').value = count;
                    }
                    else{
                        document.getElementById('presentSalary').value = parseInt(document.getElementById('incrementAmount').value);
                    }
                }
                xhttp.open("GET", "/api/user-search?id=" + employee);
                xhttp.send();
            }
        }
    </script>
@endsection
