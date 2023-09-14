@extends('master.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="col-lg-12 bg-white mx-auto mt-5">
            <div class="card bg-white">
            <h4 class="card-header">All Menu</h4>

                <div class="card-body bg-white">
                    <h4 class="text-success">{{Session::get('message')}}</h4>
                    <div class="bg-white">
                        <form action="" method="GET">
                            <div class="form-group row">
                                <label class="col-md-6">
                                    <input type="text" class="form-control bg-white" name="searchText" value="Search"/>
                                </label>
                                <div class="col-md-6 ml-0">
                                    <span class="float-right col-md-6"><a href="{{route('addMenuView')}}" class="btn btn-success float-right">+Add</a></span>
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
                                <th>Menu Name</th>
                                <th>Menu Code</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($menus as $menu)


                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$menu->menuName}}</td>
                                    <td>{{$menu->code}}</td>

                                    <td>
                                        <a href="/menu-edit/{{$menu->id}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="{{ URL::to('/menu-delete/' . $menu->id) }}" class="delete-confirm btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>

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



@endsection
