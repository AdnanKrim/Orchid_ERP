@extends('master.app')
@section('content')
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <span>Update Stock Adjustment</span>
                            </div>
                            <div class="card-body">
                                <form action="{{route('UpdatestockAdjust')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="hidden" name="id" id="id" value="{{$stock->id}}" readonly>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="date">Date</label>
                                            <input class="form-control" type="date" name="date" id="date" value="{{$stock->Date}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="branch">Business Branch</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="branch" id="branch"data-live-search="true">
                                                    <option value="">Select a branch</option>
                                                    @foreach($branches as $branch)
                                                        <option @if($branch->id === $branchName->id) selected @endif value="{{$branch->id}}">{{$branch->branchName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="adjustmentType">Adjustment Type</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="adjustmentType" id="adjustmentType" data-live-search="true">
                                                    <option @if($stock->AdjustmentType==="Normal") selected @endif value="Normal">Normal</option>
                                                    <option @if($stock->AdjustmentType==="Abnormal") selected @endif value="Abnormal">Abnormal</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="reason">Reason</label>
                                            <input class="form-control" type="text" name="reason" id="reason" placeholder="Please type the reason" value="{{$stock->Reason}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="productName">Product Name</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="productName" id="productName" data-live-search="true" onchange="StockSearch(this.value)">
                                                    <option value="">Please select a product</option>
                                                    @foreach($products as $product)
                                                        <option @if($product->id === $productName->id) selected @endif value="{{$product->id}}">{{$product->productName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="availableStock">Available Stock in Hand</label>
                                            <input class="form-control" type="number" name="availableStock" id="availableStock" value="{{$stock->AvailableStock}}" readonly>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="newStock">New Stock in Hand</label>
                                            <input class="form-control" type="number" name="newStock" id="newStock" value="{{$stock->NewStock}}" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="adjustmentQuantity">Adjustment Quantity</label>
                                            <input class="form-control" type="number" name="adjustmentQuantity" id="adjustmentQuantity" value="{{$stock->AdjustmentQuantity}}" onkeyup="TotalAmount(this.value)">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check form-check-inline mt-4">
                                                <input class="form-check-input" type="radio" name="operator" id="operator1" value="+" onclick="AdjustmentQuantity()" @if($stock->Operator==="+") checked @endif>
                                                <label class="form-check-label" for="inlineRadio1"><b>+</b></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="operator" id="operator2" value="-" onclick="AdjustmentQuantity()" @if($stock->Operator==="-") checked @endif>
                                                <label class="form-check-label" for="inlineRadio2"><b>-</b></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="totalAmount">Total Amount</label>
                                            <input class="form-control" type="number" name="totalAmount" id="totalAmount" value="{{$stock->TotalAmount}}" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="note">Note</label>
                                            <textarea class="form-control" type="note" name="note" id="note" value="{{$stock->Note}}"></textarea>
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
    <script>
        function StockSearch(product){
            if(product !== "") {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function () {
                    let resp = JSON.parse(this.response)
                    console.log(resp)
                    document.getElementById('availableStock').value = resp.stockInHand;
                    document.getElementById('totalAmount').value = resp.average;
                    document.getElementById('newStock').value = resp.stockInHand;
                    document.getElementById('adjustmentQuantity').value = 0;
                    if(document.getElementById('operator1').checked === true){
                        document.getElementById('operator1').checked = false;
                    }
                    else if(document.getElementById('operator2').checked === true){
                        document.getElementById('operator2').checked = false;
                    }
                }
                xhttp.open("GET", "/api/stock-search?ProductId=" + product);
                xhttp.send();
            }
            else {
                document.getElementById('availableStock').value = 0;
                document.getElementById('totalAmount').value = 0;
            }
        }
        function AdjustmentQuantity(){
            let adjustmentQuantity = parseInt(document.getElementById('adjustmentQuantity').value);
            let availablestock = parseInt(document.getElementById('availableStock').value);
            let count = 0;
            if (document.getElementById('operator1').checked === true){
                count = adjustmentQuantity + availablestock;
                console.log(count);
                document.getElementById('newStock').value = count;
            }
            else if(document.getElementById('operator2').checked === true){

                    count = availablestock - adjustmentQuantity
                    if(count>=0) {
                        document.getElementById('newStock').value = count;
                    }
                    else{
                        document.getElementById('newStock').value = 0;
                        document.getElementById('adjustmentQuantity').value = document.getElementById('availableStock').value;
                        let calculate = 1;
                        calculate = document.getElementById('availableStock').value * document.getElementById('availableStock').value;
                        console.log("Calculate "+calculate)
                        document.getElementById('totalAmount').value = calculate;
                    }
            }
        }
        function TotalAmount(val){
             {
                let amount = parseInt(document.getElementById('availableStock').value)
                let count = 1;
                count = val * amount;
                console.log(count)
                document.getElementById('totalAmount').value = count;
            }
        }
    </script>
@endsection
