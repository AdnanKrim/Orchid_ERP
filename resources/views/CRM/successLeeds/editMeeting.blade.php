@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Edit Meeting Form</div>
            <div class="card-body">
                <form action="{{route('update-meeting',['id'=>$leed->id, 'mId'=>$meeting->id])}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Date&Time</label>
                        <div class="col-md-8">
                            {{--                                    <input type="datetime-local" class="form-control"--}}
                            {{--                                    name="meetingDateAndTime" value="2018-06-12T19:30"--}}
                            {{--                                    min="2022-01-01T00:00" max="2024-01-01T00:00">--}}
                            <input type="text" id="dateTime"  />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">PhoneNo</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" value="{{$meeting->phoneNo}}" name="phoneNo"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Address</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$meeting->address}}" name="address"/>
                        </div>
                    </div>
                    <?php
                    $pc = \App\Models\Project\ProjectCategory::find($meeting->projectCategoryId);
                    ?>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">ProjectCategory</label>
                        <div class="col-md-8">
                            <select class="form-control bg-white" name="projectCategoryId">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ $meeting->projectCategoryId == $category->id ? 'selected' : '' }}>{{$category->projectCategoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Detail</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$meeting->detail}}" name="detail"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">clientComments</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$meeting->clientComments}}" name="clientComments"/>
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
    </div>
@endsection
