@extends('master.app')
@section('content')
    <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-lg-8 bg-white mx-auto mt-5">
                <div class="card bg-white">
                    <h4 class="card-header text-center">{{$supplier->companyOrStoreName}}</h4>

                    <div class="card-body bg-white">
                        <h5 class="mb-4">
                            <a href="" >Transaction List   </a>
                            <span><a href="" >   Payment Voucher</a></span>

                        </h5>
                        <h4 class="text-success">{{Session::get('message')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="myTable">
                                <thead class="bg-orange">
                                <tr class="text-light">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Bill No</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Open Balance</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($purchases as $value)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$value->date}}</td>
                                        <td>{{$value->purchaseId}}</td>
                                        <td>{{$value->paid}}</td>
                                        <td>{{$value->due}}</td>
                                        <td>{{$value->grandTotal}}</td>
                                        <td>
                                            <a href="" class="btn btn-info">
                                                <i class=""></i>Pay
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <?php
                                $allDues = 0;
                                $allPaids = 0;
                                $allGrands = 0;
                                foreach ($purchases as $value){
                                    $allDues += $value->due;
                                    $allPaids += $value->paid;
                                    $allGrands += $value->grandTotal;
                                }
                                ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td>{{$allPaids}}</td>
                                    <td>{{$allDues}}</td>
                                    <td>{{$allGrands}}</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 bg-white" style="margin-left: 243px">
                <div class="card bg-white">
                    <h5 class="card-header text-center">@{{name}}</h5>
                    <div class="card-body bg-white">
                        <div>@{{name}}</div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    <script src='https://cdn.jsdelivr.net/lodash/4.17.2/lodash.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        new Vue({
            el: '#app',
            data: {
                name: 'Sreejon',

            },
            methods: {

            },
            mounted() {

            }
        });
    </script>
@endsection


