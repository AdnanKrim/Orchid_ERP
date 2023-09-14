@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Add Measurement Type</div>
            <div class="card-body">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <form action="{{route('new-measure-type', ['id'=>$leed->id])}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Measurement Type Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" required name="measurementTypeName"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Unit</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" required name="unit"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Rate</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" required name="rate"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="note"></textarea>
                        </div>
                    </div>
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
@endsection

