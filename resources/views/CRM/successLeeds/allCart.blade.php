@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <img src="{{asset($leed->logo)}}" height="80" width="100">
                <h1 class="text-success float-right">Orchid Architect's</h1>
            </div>


            <div class="card-body bg-white">
                <div class="">
                    <h6>Date: </h6>
                    <h3>To</h3>
                    <h6 class="text-bold">Company Name: {{$leed->clientName}}</h6>
                    <h6>Contact: {{$leed->email}}</h6>
                    <h5>Subject: gjkdfggdg  dfgj gdg gfd gh </h5>
                    <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, enim et fuga nostrum obcaecati quam recusandae voluptatibus. Alias, corporis suscipit. Adipisci eligendi possimus quibusdam tenetur voluptatum? Atque distinctio doloremque impedit.</h5>
                </div>
{{--                <h4 class="text-success">{{Session::get('message')}}</h4>--}}
                <div class="bg-white">
                    <form action="" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-6">

                            </label>
                            <div class="col-md-6 ml-0">
                                <span class="float-right col-md-6"><a href="{{route('add-cart',['id'=>$leed->id])}}" class="btn btn-success float-right">+Add</a></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="bg-orange">
                        <tr class="text-light">
                            <th>#</th>
                            <th>HouseAreaType</th>
                            <th>DecorationTypeName</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>



                            <tr>
                                <th scope="row"></th>

                                <td>t</td>

                                <td>t</td>
                                <td>t</td>
                                <td>t</td>
                                <td>t</td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-warning btn-sm">
                                        <i class="fa fa-list"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form method="POST" action="">
                                        @csrf
                                    </form>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteDecor(id)
        {
            event.preventDefault();
            var check = confirm('Are you sure want to delete this!');
            if(check)
            {
                document.getElementById('deleteDecorForm'+id).submit();
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


