@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Edit Measurement Type</div>
            <div class="card-body">
{{--                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                <form action="{{route('update-measure-type', ['id'=>$leed->id, 'mtId'=>$measureType->id])}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Measurement Type Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$measureType->measurementTypeName}}" required name="measurementTypeName"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Unit</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$measureType->unit}}" required name="unit"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Rate</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" value="{{$measureType->rate}}" required name="rate"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="note">{{$measureType->note}}</textarea>
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

