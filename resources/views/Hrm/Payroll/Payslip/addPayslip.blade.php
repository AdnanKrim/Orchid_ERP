@extends('master.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="card">
                 <div class="card-header">
                    <span>Generate Payslip</span>
                 </div>
                <div class="card-body">
                        <div class="form-group row">
                        <label class="col-md-4 col-form-label">Employee</label>
                            <div class="col-md-8">
                                <div class="input-group search_select_box">
                                    <select class="form-control" name="employee" id="employee" data-live-search="true">
                                        <option value="">Choose an Employee</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-md-4 col-form-label">Month</label>
                            <div class="col-md-8">
                                <div class="input-group search_select_box">
                                    <select class="form-control" id = "month" name="month" data-live-search="true">
                                        <option value="">Select a month</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-md-4 col-form-label">Year</label>
                            <div class="col-md-8">
                                     @php
                                    $years = array();
                                    $currentYear = date("Y");
                                    for ($i = $currentYear; $i < ($currentYear+101); $i++) {
                                        $years[$i] = $i;
                                    }
                                    @endphp
                                    <div class="input-group search_select_box">
                                    <select class="form-control" name="year" id="year" data-live-search="true">
                                        <option value="">Choose a year</option>
                                        @foreach ($years as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <button class="btn btn-success" onclick="filter()">Search</button>
                                    </div>
                        </div>
                    <div>
                        <div class="table-responsive" style="display:none" id="slipList">
                        <div class="d-flex justify-content-center" ><h4 id="date">Payment for</h4></div>
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                    <tr class="text-light">
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Employee Id</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Basic Salary</th>
                                        <th>Net Salary</th>
                                        <th>Employee Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="slipData"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-2" id="paymentBox" style="display:none">
                        <div class="card">
                        <div class="card-header"><span id="paymentCardHeader"></span></div>
                        <div class="card-body">
                            <form action="{{route('GeneratePayslipPost')}}" method="POST">
                                @csrf
                                <input class="form-control" type="hidden" name="id" id="id" readonly/>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="netSal">Net Salary</label>
                                        <input class="form-control" type="text" name="netSal" id="netSal" readonly/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="method">Payment Method</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" id = "method" name="method" data-live-search="true">
                                                <option value="">Select a payment method</option>
                                                <option value="Net Banking">Net Banking</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" name="comment" id="comment" cols="10" rows="5"></textarea>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="Pay Now">
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <script>
        function filter() {
            let employee = document.getElementById('employee').value
            let month = document.getElementById('month').value
            let year = document.getElementById('year').value
            document.getElementById('slipList').style.display = 'block';
            document.getElementById('date').innerHTML= "Payment For "+month+","+year
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                let resp = JSON.parse(this.response)
                console.log(resp)
                for (let i = 0; i <resp.generate.length; i++) {
                    document.getElementById('slipData').innerHTML+="<tr>" +
                        "<td>"+(i+1)+"</td>" +
                        "<td>"+resp.user.name+"</td>"+
                        "<td>"+resp.user.id+"</td>"+
                        "<td>"+resp.designation.designationName+"</td>"+
                        "<td>"+resp.department.departmentName+"</td>"+
                        "<td>"+resp.user.BasicSalary+"</td>"+
                        "<td>"+resp.generate[i].netSalary+"</td>"+
                        "<td>"+resp.designation.attendanceType+"</td>"+
                        "<td>"+resp.generate[i].status+"</td>"+
                        "<td>"+"<button class='btn btn-success' "+"onclick='payment("+resp.generate[i].id+","+resp.generate[i].netSalary+")'"+">"+"<i class='bi bi-credit-card-2-back-fill me-1'></i>Paynow"+"</button>"+"</td>"+
                        //"<td><button class='btn btn-success' onclick='payment()'><i class='bi bi-credit-card-2-back-fill me-1'></i>Paynow</button></td>"+
                        "</tr>"
                }
            }
                xhttp.open("GET", "/api/payroll-generator?employee=" + employee + "&month=" + month + "&year=" + year);
                xhttp.send();
        }
        function payment(id,netSal) {
            let month = document.getElementById('month').value
            let year = document.getElementById('year').value
            console.log("id: "+id)
            console.log("sal: "+netSal)
            document.getElementById('paymentBox').style.display = 'block';
            document.getElementById('paymentCardHeader').innerText = "Payment for " + month + ", "+year
            document.getElementById('netSal').value = netSal
            document.getElementById('id').value = id
        }
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
                title: 'Payment done successfully'
            })
        }

  </script>
  @endsection
