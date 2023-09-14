@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">All Subject & body</h4>

            <div class="card-body bg-white">
{{--                <h4 class="text-success">{{Session::get('message')}}</h4>--}}
                <div class="bg-white">
                    <form action="" method="GET">
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
                            <th>Type</th>
                            <th>subject</th>
                            <th class="col-md-6">body</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($subBody as $subBody)


                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$subBody->type}}</td>
                                <td>{{$subBody->subject}}</td>
                                <td>{{$subBody->body}}</td>
                                <td>
                                    <a href="{{route('edit-sub-body', ['id'=>$leed->id])}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="deleteSB({{$subBody->id}})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form method="POST" action="" id="deleteSBForm{{$subBody->id}}">
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
        function deleteSB(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteSBForm'+id).submit();
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
@endsection


