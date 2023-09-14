@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <h3 class="card-header text-center">All Company Information </h3>
                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="{{ route('CompanyInfoSearch') }}" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="query" value="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="{{route('add-company-info')}}" class="btn btn-success float-right">+Add</a></span>
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
                                    <th>Company Name</th>
                                    <th>Logo</th>
                                    <th>Fav Icon</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th colspan="2">Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Slogan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($companyInfo as $companyInfo)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$companyInfo->companyName}}</td>
                                        <td><img src="{{ asset($companyInfo->logo) }}" width= '50' height='50' class="img img-responsive" /></td>
                                        <td><img src="{{ asset($companyInfo->favicon) }}" width= '50' height='50' class="img img-responsive" /> </td>
                                        <td>{{$companyInfo->phone}}</td>
                                        <td>{{$companyInfo->email}}</td>
                                        <td colspan="2">{{$companyInfo->address}}</td>
                                        <td>{{$companyInfo->city}}</td>
                                        <td>{{$companyInfo->state}}</td>
                                        <td>{{$companyInfo->country}}</td>
                                        <td>{{$companyInfo->slogan}}</td>
                                        <td>
                                            <a href="{{route('editCompanyInfo',['id'=>$companyInfo->id])}}" class="btn btn-success btn-sm mb-1">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('companyInfo', $companyInfo->id) }}" >
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
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Company Info Delete</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('deleteCompanyInfo') }}" class="form-group" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" id="user-id" name="id">
                            <span class="text-dark">Are you sure to delete this CompanyInfo.?</span>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-danger" id="yes" value="Yes">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{--        <script>--}}
        {{--            function deleteGroup(id)--}}
        {{--            {--}}
        {{--                event.preventDefault();--}}
        {{--                var check = confirm('Are you sure want to delete this!');--}}
        {{--                if(check)--}}
        {{--                {--}}
        {{--                    document.getElementById('deleteCompanyInfo'+id).submit();--}}
        {{--                }--}}
        {{--            }--}}
        {{--        </script>--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            //-----------cancel ride---------------
            $(document).ready(function () {

                $('body').on('click', '#delete', function () {
                    var userURL = $(this).data('url');
                    $.get(userURL, function (data) {
                        $('#deleteModal').modal('show');
                        $('#user-id').val(data.id);

                    })
                });
            });
        </script>
    </div>
@endsection
