<div class="modal fade" id="detailModal{{$purchase->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Purchase Detail</h3>

                <a href="/purchase-pdf/{{$purchase['id']}}" class="btn btn-danger btn-sm" title="pdf">
                    {{--                    <i class="fa fa-edit"></i>--}}
                    <i class="fa fa-print">  PRINT</i>
                </a>

                <a href="/mail-pdf/{{$purchase['id']}}" class="btn btn-primary btn-sm" title="mail">
                    {{--                    <i class="fa fa-edit"></i>--}}
                    <i class="fa-solid fa-envelope">  Mail</i>
{{--                    <i class="fas fa-briefcase" style="font-size:24px"></i>--}}
                </a>
                <a href="/download-pdf/{{$purchase['id']}}" class="btn btn-secondary btn-sm" title="download">
                    {{--                    <i class="fa fa-edit"></i>--}}
                    <i class="fa fa-download">  DOWNLOAD</i>
                </a>

            </div>
            <div class="modal-body">
                <div class="modal-element" >
                    <?php
                    $products = json_decode($purchase['products']);
                    $pdt = \App\Models\User::where('id','=', $purchase->userId)->first();
                    $client =\App\Models\CRM\Leeds::where('id','=',$purchase->clientId)->first();
                    $supp = \App\Models\Supplier\Supplier::where('id','=',$purchase->supplierId)->first();
                    $purId =\App\Models\Purchase\PurchaseType::where('id','=',$purchase->purchaseCategory)->first();
                    ?>
                    <div class="row" style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Purchase Category:</label>
                        <label class="col-md-6 col-form-label">{{$purId->purchaseType}}</label>
                    </div>
                        <div class="row" style="background-color: orange;">
                            <label class="col-md-6 col-form-label">Purchase Id:</label>
                            <label class="col-md-6 col-form-label">{{$purchase->purchaseId}}</label>
                        </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">User Name:</label>
                        <label class="col-md-6 col-form-label">{{$pdt->name}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Client Name:</label>
                        <label class="col-md-6 col-form-label">{{$client->clientName}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Supplier Name:</label>
                        <label class="col-md-6 col-form-label">{{$supp->companyOrStoreName}}</label>
                    </div>
                    <hr style=" border: 1px solid ;">
                    <div class="row">
                        @foreach($products as $product)
                            <?php
                            $good = \App\Models\Product\Product::where('id','=',$product->productId)->first();

                            ?>
                            <div class="col-md-6">
                                <span style="font-weight: bold;"> ProductName:</span><span style="color: red; font-weight: bold;">{{$good->productName}}</span> <br>
                                <span style="font-weight: bold;"> Quantity:</span><span style="color: red; font-weight: bold;">{{$product->quantity}}</span> <br>
                                <span style="font-weight: bold;"> Rate:</span><span style="color: red; font-weight: bold;">{{$product->rate}}</span><br>
                                <span style="font-weight: bold;"> Price:</span><span style="color: red; font-weight: bold;">{{$product->price}}</span>
                            </div>
                        @endforeach
                    </div>
                    <hr style=" border: 1px solid ;">
                    <div class="row"style="background-color: orange;" >
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Grand Total:(Including Vat & Discount)</label>
                            <label class="col-form-label">{{$purchase->grandTotal}}</label>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Payment:</label>
                            <label class="col-form-label">{{$purchase->paid}}</label>
                        </div>

                    </div>

                    <div class="row"style="background-color: orange;">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Due:</label>
                            <label class="col-form-label">{{$purchase->due}}</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Date:</label>
                            <label class="col-form-label">{{$purchase->date}}</label>
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
