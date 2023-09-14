@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="content-wrapper mx-auto">
        <section class="pb-5 pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-center fs-3 text-info fw-bold" style="font-weight:700;font-size:2rem;">Design Work Data</div>
                            <div class="card-body">
                                <h4 class="text-success">{{ Session::get('Success_Message') }}</h4>
                                <div class="table-responsive col-md-12 ">
                                    @if($design != "empty")
                                        <form action="{{route('updateDesignWork',['id'=>$leed->id,'did'=>$design->id])}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-flex flex-row justify-content-around">
                                                <input type="hidden" name="leedId" value="{{ $leed->id }}">
                                                <div class="form-group row d-flex flex-column">
                                                    <label class="mb-2">Work Time</label>
                                                    <input  type="text" class="form-control col-md-5"  name="workTime" value="{{$design->workTime}}" required/>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="">Start Date </label>
                                                    <input type="date" value="{{$design->startDate}}" class="form-control" name="startDate"/>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="">End Date</label>
                                                    <input type="date" value="{{$design->endDate }}" class="form-control" name="endDate"/>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row justify-content-between col-md-12">
                                                <div class="col-md-4 form-check mx-auto" style="margin-left: 20% !important;">
                                                    <label class="col-form-label col-md-8">Work Progress</label>
                                                    <div class=" input-group col-md-4 search_select_box" >
                                                        <select id="state" class="form-control bg-white" name="workProgress" data-live-search="true">
{{--                                                            <option value="{{ $design->workProgress }}" selected>{{ $design->workProgress }}%</option>--}}
                                                            <option value="0" @if($design->workProgress == 0) selected @endif>0%</option>
                                                            <option value="10" @if($design->workProgress == 10) selected @endif>10%</option>
                                                            <option value="20" @if($design->workProgress == 20) selected @endif>20%</option>
                                                            <option value="30" @if($design->workProgress == 30) selected @endif>30%</option>
                                                            <option value="40" @if($design->workProgress == 40) selected @endif>40%</option>
                                                            <option value="50" @if($design->workProgress == 50) selected @endif>50%</option>
                                                            <option value="60" @if($design->workProgress == 60) selected @endif>60%</option>
                                                            <option value="70" @if($design->workProgress == 70) selected @endif>70%</option>
                                                            <option value="80" @if($design->workProgress == 80) selected @endif>80%</option>
                                                            <option value="90" @if($design->workProgress == 90) selected @endif>90%</option>
                                                            <option value="100" @if($design->workProgress == 100) selected @endif>100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form-check " style="margin-right: 16% !important;">
                                                    <label class=" col-form-label">Assign To</label>
                                                    <div class="d-flex flex-column ps-5 addStyle">
                                                        <div class=" form-check mb-1">
                                                            @php
                                                                $items = json_decode($design->assignTo);
                                                            @endphp
                                                            @foreach($users as $user)
                                                                <input class="form-check-input" type="checkbox" value="{{ $user->id }}"  name="assignTo[]"  @if(isset($items) && in_array($user->id, $items)) checked  @endif >
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                    {{ $user->name }}
                                                                </label><br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-2">
                                                <button class="btn btn-primary  mx-auto" type="submit" style="width:23%;">Update</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{route('createDesignWork',['id'=>$leed->id])}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="leedId" value="{{ $leed->id }}">
                                            <div class="d-flex flex-row justify-content-around">
                                                <div class="form-group row d-flex flex-column">
                                                    <label class="mb-2">Work Time</label>
                                                    <input  type="text" class="form-control col-md-5"  name="workTime" required/>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="">Start Date </label>
                                                    <input type="date"  required  class="form-control" name="startDate"/>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="">End Date</label>
                                                    <input required type="date" value="" class="form-control" name="endDate"/>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row justify-content-between col-md-12">
                                                <div class="col-md-4 form-check mx-auto" style="margin-left: 20% !important;">
                                                    <label class="col-form-label col-md-8">Work Progress</label>
                                                    <div class=" input-group col-md-4 search_select_box" >
                                                        <select required="" id="state" class="form-control bg-white" name="workProgress" data-live-search="true">
                                                            <option value="">0%</option>
                                                            <option value="10">10%</option>
                                                            <option value="20">20%</option>
                                                            <option value="30">30%</option>
                                                            <option value="40">40%</option>
                                                            <option value="50">50%</option>
                                                            <option value="60">60%</option>
                                                            <option value="70">70%</option>
                                                            <option value="80">80%</option>
                                                            <option value="90">90%</option>
                                                            <option value="100">100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form-check " style="margin-right: 16% !important;">
                                                    <label class=" col-form-label">Assign To</label>
                                                    <div class="d-flex flex-column ps-5 addStyle">
                                                        <div class=" form-check mb-1">
                                                            @foreach($users as $user)
                                                                <input class="form-check-input" type="checkbox" value="{{ $user->id }}"  name="assignTo[]">
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                    {{ $user->name }}
                                                                </label><br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-2">
                                                <button class="btn btn-primary  mx-auto" type="submit" style="width:23%;">Insert</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body d-flex flex-row justify-content-between">
                                <div class="col-md-6">
                                    <div class="card-header text-center fs-3 text-info fw-bold" style="font-weight:700;font-size:2rem;">Comments</div>
                                    @if($design != "empty")
                                        <form action="{{route('insertComment',['id'=>$leed->id])}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @php
                                                $v = auth()->user()->id;
                                            @endphp
                                            <input type="hidden" value="{{$design->id}}" name="designWorkId">
                                            <input type="hidden" value="{{$v}}" name="userId">
                                            @if(!$comment)
                                                <h2>No Comment</h2>
                                            @else
                                                @foreach($comment as $SingleComment)
                                                    @if(auth()->user()->id == $SingleComment->userId)
                                                        <div class="form-group row">
                                                            <div class="col-md-8" >
                                                                <h5 class="border border-primary border-3 py-3 text-center"> {{$SingleComment->comment}} </h5>
                                                            </div>
                                                            <label class="col-md-3 col-form-label mx-auto ms-5" >
                                                                @if($SingleComment->photo)
                                                                    <img src="{{ $SingleComment->photo }}" width= '50' height='50' class="img img-responsive" />
                                                                @else
                                                                    <img src="{{ asset('/backend/dist/img/avatar.png') }}" width= '50' height='50' class="img img-responsive" /> <br>
                                                                @endif
                                                                {{$SingleComment->name}}
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label">
                                                                @if($SingleComment->photo)
                                                                    <img src="{{ $SingleComment->photo }}" width= '50' height='50' class="img img-responsive" />
                                                                @else
                                                                    <img src="{{ asset('/backend/dist/img/avatar.png') }}" width= '50' height='50' class="img img-responsive" /> <br>
                                                                @endif
                                                                {{$SingleComment->name}}
                                                            </label>
                                                            <div class="col-md-8">
                                                                <h5 class="border border-primary border-3 py-3 text-center"> {{$SingleComment->comment}} </h5>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <div class="form-group row">
                                                <div class="col-md-10 mx-auto">
                                                    <textarea class="form-control" id="comment" name="comment">
                                            </textarea>
                                                </div>
                                            </div>
                                            <div class="text-center mt-2">
                                                <button class="btn btn-primary  mx-auto" type="submit" style="width:44%;">Add New Comment</button>
                                            </div>
                                        </form>
                                    @else
                                        <h2 class="mt-4"> Please Add Design Work First</h2>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="card-header text-center fs-3 text-info fw-bold" style="font-weight:700;font-size:2rem;">Files</div>
                                    <div class="table-responsive">
                                        @if(!$files)
                                            <h2>Add Files</h2>
                                        @else
                                            <table class="table table-bordered mb-0">
                                                <thead class="bg-orange">
                                                <tr class="text-light">
                                                    <th>File Name</th>
                                                    <th>File</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($files as $file)
                                                    @php
                                                        $v = pathinfo($file->file, PATHINFO_EXTENSION);
                                                    @endphp
                                                    <tr>
                                                        <td>{{$file->fileName}}
                                                        </td>
                                                        @if($v == 'png'||$v == 'jpeg'||$v == 'png'|| $v == 'jpg'|| $v == 'ico')
                                                            <td><img src="{{ asset($file->file) }}" width= '50' height='50' class="img img-responsive" />
                                                                <a href="{{route('download-file',['id'=>$leed->id,$file->id])}}">
                                                            <span style="float:right">
                                                        <i class="fa-solid fa-download fa-xl ml-2" style="color:green;"></i> Download</span>
                                                                </a>
                                                            </td>
                                                        @else
                                                            <td> <i class="fa-solid fa-file-pdf fa-xl" style="color:red;width:30px"></i>{{$file->fileName}}. {{$v }}
                                                                <a href="{{route('download-file',['id'=>$leed->id,$file->id])}}">
                                                            <span style="float:right">
                                                        <i class="fa-solid fa-download fa-xl ml-2" style="color:green;"></i> Download</span>
                                                                </a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                        @if($design != "empty")
                                            <form action="{{route('insertFile',['id'=>$leed->id])}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="designWorkId" value ="{{$design->id}}">
                                                <input type="hidden" name="userId" value="{{$user->id}}">
                                                <div class="d-flex flex-row justify-content-between mx-auto">
                                                    <div class="form-group row col-md-5 mt-3">
                                                        <label class="">File Name</label>
                                                        <input type="text" class="form-control"  name="fileName"/>
                                                    </div>
                                                    <div class="form-group row col-md-7 mt-3">
                                                        <label class="">Select File</label>
                                                        <input type="file" class="form-control"  name="file"/>
                                                    </div>
                                                </div>
                                                <div class="text-center mt-2">
                                                    <button class="btn btn-primary  mx-auto" type="submit" style="width:44%;">Add New File</button>
                                                </div>
                                            </form>
                                        @else
                                            <h2 class="mt-4">Please Add Design Work First</h2>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection
