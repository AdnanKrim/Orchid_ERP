@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="content-wrapper mx-auto">
        <section class="pb-5 pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">Add Cart</div>
                            <div class="card-body">
                                <h4 class="text-success">{{ Session::get('message') }}</h4>
                                <div class="table-responsive">
                                    <form action="{{ route('updateDesignWork',['id'=>$leed->id,'did'=>$design->id]) }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Work Time</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" value="{{ $design->workTime}}" name="workTime"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Start Date </label>
                                            <div class="col-md-5">
                                                <input type="date" value="{{$design->startDate}}" class="form-control" name="startDate"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">End Date</label>
                                            <div class="col-md-5">
                                                <input type="date" value="{{$design->endDate }}" class="form-control" name="endDate"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Work Progress</label>
                                            <div class="col-md-5">
                                                <input type="text" value="{{$design->workProgress}}" class="form-control" name="workProgress"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Assign To</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" value="{{$design->assignTo}}" name="assignTo"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"></label>
                                            <div class="col-md-9">
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
        </section>
    </div>
@endsection
