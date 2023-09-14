@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Edit Decoration Type</div>
            <div class="card-body">
                <h4 class="text-success">{{ Session::get('message') }}</h4>
                <form action="{{route('update-decoration-type', ['id'=>$leed->id, 'decor'=>$decorationType->id])}}" method="post">
                    @csrf
                    <div class="form-group row mb-2">
                        <label for="name" class="col-sm-4 col-form-label">houseAreaTypeName<span style='color: red;'>*</span></label>
                        <div class="col-sm-8 input-group">
                            <select class="form-control select2" required name="houseAreaTypeId">
                                <option>{{$decorationType->houseAreaTypeId}}</option>
                                @foreach($houseTypes as $houseType)
                                    <option value="{{$houseType->id}}">{{$houseType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Decoration Type</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$decorationType->name}}" required name="name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$decorationType->description}}" required name="description"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Unit</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$decorationType->unit}}" required name="unit"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Rate</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" value="{{$decorationType->rate}}" required name="rate"/>
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
@endsection('leedContent')
