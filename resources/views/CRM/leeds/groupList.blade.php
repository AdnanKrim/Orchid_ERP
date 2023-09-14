@extends('master.app')
@section('content')
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="col-lg-8 bg-white mx-auto mt-5">
            <div class="card bg-white">
            <h4 class="card-header">All Leeds Group</h4>

                <div class="card-body bg-white">
{{--                    <h4 class="text-success">{{Session::get('message')}}</h4>--}}
                    <div class="bg-white">
                        <form action="{{route('search-group')}}" method="GET">
                            <div class="form-group row">
                                <label class="col-md-6">
                                    <input type="text" class="form-control bg-white" name="searchText" value="Search"/>
                                </label>
                                <div class="col-md-6 ml-0">
                                    <span class="float-right col-md-6"><a href="{{route('add-group')}}" class="btn btn-success float-right">+Add</a></span>
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
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($groups as $group)


                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$group->leedsGroupName}}</td>
                                    <td>
                                        <a href="{{route('edit-group', ['id'=>$group->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('leeds-in-group', ['id'=>$group->id])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-list"></i>
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm" onclick="deleteGroup({{$group->id}})">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form method="POST" action="{{route('delete-group',['id' => $group->id])}}" id="deleteGroupForm{{$group->id}}">
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
        function deleteGroup(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteGroupForm'+id).submit();
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
</div>
@endsection
