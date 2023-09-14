@extends('master.app')
@section('content')
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <span>Update Chart of Account</span>
                            </div>
                            <div class="card-body">
                                <form action="{{route('updateAccountChart')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="hidden" name="id" id="id" value="{{$charts->id}}">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="accType">Account Type</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="accType" id="accType">
                                                    <option selected value="" disabled>Select an Account type</option>
                                                    @foreach ($accountTypes as $type)
                                                        <option @if($type->id === $accountTypeName->id) selected @endif value="{{$type->id}}">{{$type->AccountType}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="accGroup">Account Group</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="accGroup" id="accGroup">
                                                    <option selected value="" disabled>Select an Account group</option>
                                                    @foreach ($accountGroups as $group)
                                                        <option @if($group->id === $accountGroupName->id) selected @endif value="{{$group->id}}">{{$group->AccountGroup}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="name">Account Name</label>
                                            <input class="form-control" type="text" name="name" id="name" value="{{$charts->AccountName}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="side">Side</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="side" id="side">
                                                    <option selected value="" disabled>Choose a side</option>
                                                    <option @if($charts->Side === "Debit") selected @endif value="Debit">Debit</option>
                                                    <option @if($charts->Side === "Credit") selected @endif value="Credit">Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="code">Account Code</label>
                                            <input class="form-control" type="text" name="code" id="code" value="{{$charts->AccountCode}}" >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="balance">Balance</label>
                                            <input class="form-control" type="number" name="balance" id="balance" value="{{$charts->Balance}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date">As of date</label>
                                            <input class="form-control" type="date" name="date" id="date" value="{{$charts->Date}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Update"/>
                                        </div>
                                    </div>
                                    <input v-model="typeId">
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
