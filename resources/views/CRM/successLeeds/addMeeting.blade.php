@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
<div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Add Meeting Form</div>
                        <div class="card-body">
{{--                            <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                            <form action="{{route('new-meeting',['id'=>$leed->id])}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Date&Time</label>
                                    <div class="col-md-8">
{{--                                    <input type="datetime-local" class="form-control"--}}
{{--                                    name="meetingDateAndTime" value="2018-06-12T19:30"--}}
{{--                                    min="2022-01-01T00:00" max="2024-01-01T00:00">--}}
                                        <input type="text" id="dateTime"  name="meetingDateAndTime"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">PhoneNo</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" value="{{$leed->phoneNo}}" name="phoneNo"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Address</label>
                                    <div class="col-md-8">
                                         <textarea class="form-control" id="comment" name="address" value="{{$leed->address}}"></textarea>
{{--                                        <input type="text" class="form-control" name="address" style="height:66px"/>--}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Project Category</label>
                                    <div class="col-md-8">
                                    <select class="form-control bg-white" name="projectCategoryId">
                                        <option>Select Value</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->projectCategoryName}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Details</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="detail"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Client Comments</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="clientComments"/>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-md-4 col-form-label"></label>
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-success" value="Save"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
</div>
@endsection
