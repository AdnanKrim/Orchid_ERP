@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Update Unit Form</div>
                            <div class="card-body">
                                <form action="/u-update/{{$unit->id}}" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Unit Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="uniteName" value="{{$unit->uniteName}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Unit Short<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="uniteShort" value="{{$unit->uniteShort}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Allow Decimal</label>
                                        <div class="col-md-8">
                                            <input type="text" style="height:4rem;" class="form-control" name="allowDecimal" value="{{$unit->allowDecimal}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Update" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
