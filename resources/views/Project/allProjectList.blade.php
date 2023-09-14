@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <div class="card bg-white">
                    <h4 class="card-header">All Project List</h4>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="#" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="hidden" class="form-control bg-white" name="dealSearch" id="dealSearch" onkeyup="myFunction()" placeholder="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="{{route('addDeal')}}" class="btn btn-success float-right">+Add</a></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Project Start Date</th>
                                    <th >Project Category</th>
                                    <th >Client Name</th>
                                    <th >Total Project Amount</th>
                                    <th >Paid</th>
                                    <th >Payment Due</th>
                                    <th >Assign to</th>
                                    <th >Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deals as $deal)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$deal->startDate}}</td>
                                        <td>
                                            @foreach($categories as $category)
                                            @if($category->id===$deal->category)
                                            {{$category->projectCategoryName}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                        @foreach($clients as $client)
                                            @if($client->id===$deal->ClientName)
                                            {{$client->clientName}}
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>{{$deal->amount}} BDT</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        @foreach($clients as $client)
                                        @foreach($users as $user)
                                            @if($client->assignedTo===$user->id)
                                            {{$user->name}}
                                            @endif
                                        @endforeach
                                        @endforeach
                                        </td>
                                        <td>
                                            <select class="form-control" id="status" onchange="change(this.value,{{$deal->id}})">
                                                <option @if($deal->status==="Running") selected @endif value="Running">Running</option>
                                                <option @if($deal->status==="Completed") selected @endif value="Completed">Completed</option>
                                                <option @if($deal->status==="Rejected") selected @endif value="Rejected">Rejected</option>
                                            </select>
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
    </div>
<script>
          function change(value,id) {
        var fd = new FormData();
        fd.append("status",value);
		fd.append("id",id);
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
			if (this.status===200) {
				  console.log(this.response);
			}
		}
		xhttp.open("post","/api/project-status-update"); //connected with backend
		xhttp.send(fd);
        var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Project status Updated Successfully'
            })
        }
</script>
@endsection
