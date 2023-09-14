

    <div class="col-md-9" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="card">
            <div class="card-header">Add Cart</div>
            <div class="card-body">
                <h4 class="text-success">{{ Session::get('message') }}</h4>
                <form action="" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">House Area Type</label>
                        <div class="col-md-8">
                            <select class="form-control select2" wire:model="selectedHouseType" id="houseType" required name="houseAreaTypeId">
                                <option>Search House Area Types</option>
                                @foreach($houseTypes as $houseType)
                                    <option value="{{$houseType->id}}">{{$houseType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="name" class="col-sm-4 col-form-label">Decoration Type<span style='color: red;'>*</span></label>
                        <div class="col-sm-8 input-group">
                            <select class="form-control select2" required name="description">
                                <option>Search</option>
                                @foreach($decTypes as $decType)
                                    <option value="{{$decType->id}}">{{$decType->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


