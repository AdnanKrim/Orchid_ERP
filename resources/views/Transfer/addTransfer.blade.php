@extends('master.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">Add Transfer Form</div>
                        <div class="card-body">
                            <form action="{{route('new.transfer')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Transfer From<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <select type="number" required class="form-control" name="transferFromId">
                                            <option selected disabled>--select--</option>
                                            @foreach($accounts as $value)
                                                <option value="{{$value->id}}">{{$value->accName}}-{{$value->accNo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Transfer To<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <select type="number" required class="form-control" name="transferToId">
                                            <option selected disabled>--select--</option>
                                            @foreach($accounts as $value)
                                                <option value="{{$value->id}}">{{$value->accName}}-{{$value->accNo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Amount<span class="text-danger"> *</span></label>
                                    <div class="col-md-8">
                                        <input type="number" required class="form-control" name="amount"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Date</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="date"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Reference</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="ref"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Attach File(if any)</label>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" name="file" accept="*"/>
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
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection
