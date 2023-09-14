@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-8 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <h4 class="card-header">All Decoration type</h4>

                    <div class="card-body bg-white">
                        <div class="bg-white">
                            <form action="" method="GET">
                                <div class="form-group row">
                                    <label class="col-md-6">
                                        <input type="text" class="form-control bg-white" name="categorySearch" id="categorySearch" onkeyup="myFunction()" placeholder="Search"/>
                                    </label>
                                    <div class="col-md-6 ml-0">
                                        <span class="float-right col-md-6"><a href="{{route('pb.dec.add')}}" class="btn btn-success btn-sm float-right">+Add</a></span>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Decoration type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($decorationTypes as $dec)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$dec->name}}</td>
                                        <td>
                                            <a href="{{route('pb.dec.edit',['id'=>$dec->id])}}" class="btn btn-success btn-sm me-1" title="Update">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button"  class="btn btn-danger btn-sm mx-1 deleteBtn" value="{{$dec->id}}" >
                                                <i class="fa fa-trash"></i>
                                            </button>
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
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
                <!--Content-->
                <div class="modal-content text-center">
                    <!--Header-->
                    <div class="modal-header bg-danger d-flex justify-content-center">
                        <p class="heading mt-3">Delete Confirmation</p>
                    </div>
                    <div class="modal-body text-danger">
                        <i class="fas fa-circle-xmark fa-4x animated rotateIn mb-4"></i>
                        <p>Do you want to delete this?</p>
                    </div>
                    <div class="modal-footer flex-center">
                        <form action="{{route('pb.dec.delete')}}" class="form-group" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" id="id" name="id">
                            <input type="submit" class="btn btn-danger mx-1" id="yes" value="Yes, Delete">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >close</button>
                        </form>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
    </div>
@endsection
