
@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">Search Results for {{$query}}</h4>

            <div class="card-body bg-white">
                <h4 class="text-success">{{Session::get('message')}}</h4>
                <div class="bg-white">
                    <form action="{{route('search-house-area-type',['id'=>$leed->id])}}" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-6">
                                <input type="text" class="form-control bg-white" name="searchType" value="Search"/>
                            </label>
                            <div class="col-md-6 ml-0">
                                <span class="float-right col-md-6"><a href="" class="btn btn-success float-right">+Add</a></span>
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
                            <th>HouseAreaTypeName</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($houseTypes as $houseType)


                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$houseType->name}}</td>
                                <td>
                                    <a href="{{route('edit-house-area-type', ['id'=>$leed->id, 'houseType'=>$houseType->id])}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-warning btn-sm">
                                        <i class="fa fa-list"></i>
                                    </a>
                                    <a href="{{route('delete-house-area-type', ['id'=>$leed->id, 'houseType'=>$houseType->id])}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form method="POST" action="">
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

    <script>
        function deleteType(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteTypeForm'+id).submit();
            }
        }
    </script>

@endsection
