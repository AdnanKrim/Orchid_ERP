@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-12 bg-white mx-auto mt-5">
                <h4 class="text-success">{{ Session::get('message') }}</h4>
                <div class="card bg-white">
                    <h4 class="card-header">All Labour Type</h4>

                    <div class="card-body bg-white">

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th >Labour Type Name</th>
                                    <th >Labour Code</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($labors as $labor)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$labor->labourTypeName}}</td>
                                        <td>{{$labor->code}}</td>


                                        <td>
                                            <a href="/labour-type-edit/{{$labor['id']}}" class="btn btn-success btn-sm" title="Update">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a  class="btn btn-danger btn-sm" id="delete" title="Delete" href="javascript:void(0)" data-url="{{ route('LabourTypeInfo', $labor->id) }}" >
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
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Labour Type Delete</h5>

                </div>
                <div class="modal-body">

                    <span class="text-dark">Are you sure to delete this Labour Type?</span>

                </div>
                <div class="modal-footer">
                    <form action="{{ route('deleteLabourType') }}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="user-id" name="id">
                        <input type="submit" class="btn btn-danger" id="yes" value="Yes">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

@endsection
