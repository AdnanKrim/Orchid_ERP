@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Edit Subject & Body</div>
            <div class="card-body">
                <h4 class="text-success">{{ Session::get('message') }}</h4>
                <form action="{{route('update-sub-body', ['id'=>$leed->id,'sbId'=>$subBody->id])}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Subject</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{$subBody->subject}}" required name="subject"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Body</label>
                        <div class="col-md-8">
                            <textarea class="form-control" required name="body">{{$subBody->body}}</textarea>
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

