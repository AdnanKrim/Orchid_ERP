@extends('master.app')
@section('content')


<div class="content-wrapper bg-white">
    <div class="row">
        <div class="col-lg-12 bg-white mx-auto mt-5">
            <div class="card bg-white">
            <h4 class="card-header">All Sub Menu</h4>

                <div class="card-body bg-white">
                    <h4 class="text-success">{{Session::get('message')}}</h4>
                    <div class="bg-white">
                        <form action="" method="GET">
                            <div class="form-group row">
                                <label class="col-md-6">
                                    <input type="text" class="form-control bg-white" name="searchText" value="Search"/>
                                </label>
                                <div class="col-md-6 ml-0">
                                    <span class="float-right col-md-6"><a href="{{route('addSubMenuView')}}" class="btn btn-success float-right">+Add</a></span>
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
                                <th>Menu</th>
                                <th>Submenu Name</th>
                                <th>Code</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($submenus as $submenu)
                            @foreach ($menus as $menu)
                            @if($menu->id === $submenu->menuId)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$menu->menuName}}</td>
                                    <td>{{$submenu->subMenuName}}</td>
                                    <td>{{$submenu->code}}</td>

                                    <td>
                                        <a href="/submenu-edit/{{$submenu->id}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="{{ URL::to('/submenu-delete/' . $submenu->id) }}" class="btn btn-danger btn-sm delete-confirm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        {{-- <form method="POST" action="route('deleteSubMenu')">
                                            @csrf
                                        </form> --}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
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
