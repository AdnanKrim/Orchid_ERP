@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <span>Update Account Type</span>

                            </div>
                            <div class="card-body">

                                <form action="{{route('updateAccountType')}}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" name="id" value="{{$accountType->id}}"/>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Account Type</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="type" value="{{$accountType->AccountType}}"/>
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
