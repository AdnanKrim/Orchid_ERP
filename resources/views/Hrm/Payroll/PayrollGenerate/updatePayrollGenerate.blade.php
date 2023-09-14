@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="card">
                 <div class="card-header">
                    <span>Update Payroll Generate</span>
                 </div>
                <div class="card-body">
                    <form action="{{route('updatePayrollGenerate')}}" method="POST">
                    @csrf
                    <input class="form-control" type="hidden " name="id" id="id" value="{{$generate->id}}"/>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <label for="month">Month</label>
                                        <div class="input-group search_select_box">
                                        <select class="form-control" id = "month" name="month" data-live-search="true">
                                        <option value="">Select a month</option>
                                            <option @if($generate->month==="January") selected @endif value="January">January</option>
                                            <option @if($generate->month==="February") selected @endif value="February">February</option>
                                            <option @if($generate->month==="March") selected @endif value="March">March</option>
                                            <option @if($generate->month==="April") selected @endif value="April">April</option>
                                            <option @if($generate->month==="May") selected @endif value="May">May</option>
                                            <option @if($generate->month==="June") selected @endif value="June">June</option>
                                            <option @if($generate->month==="July") selected @endif value="July">July</option>
                                            <option @if($generate->month==="August") selected @endif value="August">August</option>
                                            <option @if($generate->month==="September") selected @endif value="September">September</option>
                                            <option @if($generate->month==="October") selected @endif value="October">October</option>
                                            <option @if($generate->month==="November") selected @endif value="November">November</option>
                                            <option @if($generate->month==="December") selected @endif value="December">December</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <label for="year">Year</label>
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
                                            <option @if($generate->year == $year) selected @endif value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <label for="employee">Employee</label>
                                    <div class="input-group search_select_box">
                                    <select class="form-control" name="employee" id="employee" data-live-search="true" onchange="showEmployee(this.value)">
                                        <option value="">Choose an Employee</option>
                                        @foreach ($users as $user)
                                            <option @if($generate->employee == $user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="my-4 border p-4" style="display:none" id="employeeList">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <span><b>Employee Id: </b> <span id="empId"></span></span>
                                    </div>
                                    <div class="col-md-4">
                                    <span><b>Department: </b> <span id="Department"></span></span>
                                    </div>
                                    <div class="col-md-4">
                                    <span><b>Designation: </b> <span id="Designation"></span></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    <span><b>Business Branch: </b> <span id="branch"></span></span>
                                    </div>
                                    <div class="col-md-4">
                                    <span><b>Employement Type: </b> <span id="empType"></span></span>
                                    </div>
                                    <div class="col-md-4">
                                    <span><b>Basic Salary: </b> <span id="salary"></span></span>
                                    <input type="hidden" id="empSal">
                                    </div>
                                </div>
                                </div>


                                <div class="form-group row" id="payrollTypeZone">
                                    @foreach($payrollTypes as $type)
                                    <div class="col-md-6">
                                        @if(empty($type->tk))
                                        <label  for="">{{$type->payrollTypeName}}</label>
                                        <input class="form-control" type="text" value="{{$type->percentage}} %" readonly>
                                        @endif
                                        @if(empty($type->percentage))
                                        <label  for="">{{$type->payrollTypeName}}</label>
                                        <input class="form-control" type="text" value="{{$type->tk}} BDT" readonly>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6">
                                    <label for="commission">Sales Commission (If)</label>
                                    <input class="form-control" type="text" name="commission" id="commission" value="{{$generate->salesCommission}}" onchange="count()"/>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="netSal">Net Salary</label>
                                    <input class="form-control" type="text" name="netSal" id="netSal" value="{{$generate->netSalary}}" readonly/>
                                    </div>
                                </div>


                                <div class="form-group row mt-2">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="Update"/>
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
      function  count(){
        let commission = parseFloat(document.getElementById('commission').value);
        let total;
        if(document.getElementById('commission').value===""){
            console.log("value empty")
            total = 0;
        }
        else{
            console.log("value not empty")
              total =  commission + parseInt(document.getElementById('netSal').value)

        }
          document.getElementById('netSal').value = total;
      }

    function showEmployee(str) {
    document.getElementById('commission').value = ''
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      let resp = JSON.parse(this.response)
      console.log(resp)
      document.getElementById('employeeList').style.display = 'block';
      document.getElementById('empId').innerHTML = resp.user.id;
      document.getElementById('Department').innerHTML = resp.department.departmentName;
      document.getElementById('Designation').innerHTML = resp.designation.designationName;
      document.getElementById('branch').innerHTML = resp.branch.companyName;
      document.getElementById('empType').innerHTML = resp.employeeType;
      document.getElementById('salary').innerHTML = resp.salary + " BDT";
      document.getElementById('empSal').value = resp.salary;
      /* ------------Net salary calculation------------ */
        let count = 0;
        let empSal = resp.salary;
        const xhttp1 = new XMLHttpRequest();
        xhttp1.onload = function () {
            let resp1 = JSON.parse(this.response)
            console.log(resp1)
             for (let i = 0; i < resp1.length; i++){
      if(resp1[i].payrollGenerate === "+"){
          if(resp1[i].tk === null){
              count = count + (empSal + (empSal*(resp1[i].percentage/100)));

          }
          else if(resp1[i].percentage === null){
              count = count + empSal + resp1[i].tk;

          }
      }
      else if(resp1[i].payrollGenerate === "-"){
          if(resp1[i].tk === null){
              count = count + (empSal - (empSal*(resp1[i].percentage/100)));

          }
          else if(resp1[i].percentage === null){
              count = count + (empSal - resp1[i].tk);

          }
      }
  }
  console.log("Net sal : "+count)
  document.getElementById('netSal').value = count;
        }
        xhttp1.open("GET", "/api/all-payroll-types");
        xhttp1.send();
    }
    xhttp.open("GET", "/api/get-emp-info?id="+str);
    xhttp.send();


  }
  </script>
  @endsection
