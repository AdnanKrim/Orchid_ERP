@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-8 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <div class="card-header">Edit Decoration Type</div>
                    <div class="card-body">
                        <form action="{{route('pb.dec.update')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Decoration Type Name</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{$decorationType->name}}" class="form-control" required name="name"/>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$decorationType->id}}">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" class="btn btn-success" value="Save"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


