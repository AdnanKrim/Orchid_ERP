@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Add Decoration Type</div>
            <div class="card-body">
                <h4 class="text-success">{{ Session::get('message') }}</h4>
                <form action="{{route('new-decoration-type', ['id'=>$leed->id])}}" method="POST">
                    @csrf
                    <div class="form-group row mb-2">
                        <label for="name" class="col-sm-4 col-form-label">houseAreaTypeName<span style='color: red;'>*</span></label>
                        <div class="col-sm-8 input-group">
                            <select class="form-control select2" required name="houseAreaTypeId">
                                <option>Search HouseType</option>
                                @foreach($houseTypes as $houseType)
                                    <option value="{{$houseType->id}}">{{$houseType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Decoration Type</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" required name="name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" required name="description"/>
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
