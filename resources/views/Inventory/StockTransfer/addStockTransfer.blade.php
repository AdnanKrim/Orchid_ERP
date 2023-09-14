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
                                <span> Stock Transfer</span>
                            </div>
                            <div class="card-body">
                                <form action="{{route('stockTransferPost')}}" class="form-group" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="date">Date</label>
                                            <input class="form-control" type="date" name="date" id="date">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="from">From</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="from" id="from"data-live-search="true">
                                                    <option value="">Select a branch</option>
                                                    @foreach($branches as $branch)
                                                        <option value="{{$branch->id}}">{{$branch->branchName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="to">To</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="to" id="to"data-live-search="true">
                                                    <option value="">Select a branch</option>
                                                    @foreach($branches as $branch)
                                                        <option value="{{$branch->id}}">{{$branch->branchName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="productName">Product Name</label>
                                            <div class="input-group search_select_box">
                                                <select class="form-control" name="productName" id="productName" data-live-search="true" onchange="StockSearch(this.value)">
                                                    <option value="">Please select a product</option>
                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->productName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="availableStock">Available Stock in hand</label>
                                            <input class="form-control" type="number" name="availableStock" id="availableStock" value= 0  readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="transferQuantity">Transfer Quantity</label>
                                            <input class="form-control" type="number" name="transferQuantity" id="transferQuantity" onkeyup="AmountCalculation(this.value)">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="totalAmount">Total Amount</label>
                                            <input class="form-control" type="number" name="totalAmount" id="totalAmount" value= 0 readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shippingCharge">Shipping Charge</label>
                                            <input class="form-control" type="number" name="shippingCharge" id="shippingCharge">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="note">Note</label>
                                            <textarea class="form-control" type="note" name="note" id="note"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Add"/>
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
                let availableStock = parseInt(resp.stockInHand);
                let amount = parseInt(resp.average);
                document.getElementById('availableStock').value = availableStock;
                document.getElementById('totalAmount').value = 0;
                document.getElementById('transferQuantity').value = 0;
            }
            xhttp.open("GET", "/api/stock-search?ProductId=" + product);
            xhttp.send();
        }
        else {
            document.getElementById('availableStock').value = 0;
            document.getElementById('totalAmount').value = 0;
            document.getElementById('transferQuantity').value = 0;
        }
    }

    function AmountCalculation(quantity){
        if (quantity !== "" || quantity !== 0){
          if(parseInt(quantity)>= parseInt(document.getElementById('availableStock').value)){
              document.getElementById('transferQuantity').value = document.getElementById('availableStock').value
              const xhttp = new XMLHttpRequest();
              xhttp.onload = function (){
                  let resp = JSON.parse(this.response)
                  console.log(resp)
                  let count = 1;
                  count = parseInt(document.getElementById('transferQuantity').value)* parseInt(resp.average)
                  document.getElementById('totalAmount').value = count;
              }
              xhttp.open("GET", "/api/stock-search?ProductId=" + document.getElementById('productName').value);
              xhttp.send();
          }
          else{
              const xhttp = new XMLHttpRequest();
              xhttp.onload = function (){
                  let resp = JSON.parse(this.response)
                  console.log(resp)
                  let count = 1;
                  count = parseInt(document.getElementById('transferQuantity').value)* parseInt(resp.average)
                  document.getElementById('totalAmount').value = count;
              }
              xhttp.open("GET", "/api/stock-search?ProductId=" + document.getElementById('productName').value);
              xhttp.send();
          }
        }
        else{
            document.getElementById('totalAmount').value = 0;
        }
    }
</script>
@endsection
