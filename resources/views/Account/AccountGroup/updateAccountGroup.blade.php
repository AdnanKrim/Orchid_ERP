@extends('master.app')
@section('content')
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <span>Update Account Group</span>
                            </div>
                            <div class="card-body">
                                <form action="{{route('updateAccountGroup')}}" method="POST">
                                    @csrf
                                    <input class="form-control" type="hidden" name="id" id="id" value="{{$accountGroups->id}}">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Account Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="accType">
                                                <option selected value="" disabled>Select an Account type</option>
                                                @foreach ($accountTypes as $type)
                                                    <option @if($type->id === $accountTypeName->id) selected @endif value="{{$type->id}}">{{$type->AccountType}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Account Group</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="group" id="group" placeholder="Please write an account group under an Account Type" value="{{$accountGroups->AccountGroup}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Update"/>
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
