@extends('master.app')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="card">
                 <div class="card-header">
                    <span>Add New Project Deal</span>
                 </div>
                <div class="card-body">
                    <form action="{{route('addDealPost')}}" method="POST">
                    @csrf
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="start">Project Name<span class="text-danger"> *</span></label>
                                        <input class="form-control" type="text" name="projectName" id="start" >

                                    </div>
                                    <div class="col-md-4">
                                        <label for="start">Project Start date<span class="text-danger"> *</span></label>
                                        <input class="form-control" type="date" name="start" id="startDate" onchange="countDate()">
                                        <span class="text-danger">@error('startDate'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end">Project End date<span class="text-danger"> *</span></label>
                                        <input class="form-control" type="date" name="end" id="end" onchange="countDate()">
                                        <span class="text-danger">@error('end'){{ $message }}@enderror</span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                        <div class="col-md-4">
                                        <label for="category">Project Category<span class="text-danger"> *</span></label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="category" id="category" data-live-search="true">
                                                <option value="">Select a client</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->projectCategoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('category'){{ $message }}@enderror</span>
                                        </div>
                                    <div class="col-md-4">
                                        <label for="duration">Duration</label>
                                        <input class="form-control" type="text" name="duration" id="duration" value="0" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="category">Business Branch<span class="text-danger"> *</span></label>
                                        <select class="form-control" name="branchId" id="client" data-live-search="true">
                                            <option value="">Select Business Branch</option>
                                            @foreach($businessName as $branch)
                                                <option value="{{$branch->id}}">{{$branch->branchName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="client">Client Name<span class="text-danger"> *</span></label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="client" id="client" data-live-search="true">
                                                <option value="">Select a client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->clientName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('client'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="totalAmount">Total Project Amount<span class="text-danger"> *</span></label>
                                        <input class="form-control" type="text" name="totalAmount" id="totalAmount">
                                        <span class="text-danger">@error('totalAmount'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" name="comment" id="comment" cols="5" rows="2" placeholder="Please write some comment"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="Add"/>
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
    function countDate() {
        var d1 = document.getElementById('startDate').value;
        console.log(d1);
        var d2 = document.getElementById('end').value;
        console.log(d2);
        if(d1 != "" && d2 != ""){
        const startDate = new Date(d1);
        const end = new Date(d2);
        const totaltime = Math.abs(end - startDate);
        const totalday = Math.ceil(totaltime / (1000 * 60 * 60 * 24));
        console.log(totalday);
        document.getElementById('duration').value = totalday;
        }
        else{
            document.getElementById('duration').value = 0;
        }
    }
  </script>
  @endsection
