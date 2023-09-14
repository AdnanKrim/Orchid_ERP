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
                    <form action="{{route('updateDealPost')}}" method="POST">
                    @csrf
                    <input class="form-control" type="hidden" name="id" id="id" value="{{$deal->id}}">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="start">Project Start date</label>
                                        <input class="form-control" type="date" name="start" id="start" value="{{$deal->startDate}}" onchange="countDate()">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end">Project End date</label>
                                        <input class="form-control" type="date" name="end" id="end" value="{{$deal->endDate}}" onchange="countDate()">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="duration">Duration</label>
                                        <input class="form-control" type="text" name="duration" id="duration" value="{{$deal->duration}}" value="0" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <div class="col-md-4">
                                        <label for="category">Project Category</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="category" id="category" data-live-search="true">
                                                <option value="">Select a client</option>
                                                @foreach($categories as $category)
                                                <option @if($category->id === $categoryName ->id) selected @endif value="{{$category->id}}">{{$category->projectCategoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                    <div class="col-md-4">
                                        <label for="client">Client Name</label>
                                        <div class="input-group search_select_box">
                                            <select class="form-control" name="client" id="client" data-live-search="true">
                                                <option value="">Select a client</option>
                                                @foreach($clients as $client)
                                                <option @if($client->id === $clientName ->id) selected @endif value="{{$client->id}}">{{$client->clientName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="totalAmount">Total Project Amount</label>
                                        <input class="form-control" type="text" name="totalAmount" id="totalAmount" value="{{$deal->amount}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" name="comment" id="comment" cols="5" rows="2" placeholder="Please write some comment">{{$deal->comment}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
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
    function countDate() {
        var d1 = document.getElementById('start').value;
        var d2 = document.getElementById('end').value;
        if(d1 != "" && d2 != ""){
        const start = new Date(d1);
        const end = new Date(d2);
        const totaltime = Math.abs(end - start);
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
