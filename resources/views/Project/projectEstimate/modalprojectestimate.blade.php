<div class="modal fade" id="detailModal{{$estimate->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Purchase Detail</h3>

                <a href="/project-estimate-pdf/{{$estimate['id']}}" class="btn btn-danger btn-sm" title="pdf">
                    {{--                    <i class="fa fa-edit"></i>--}}
                    <i class="fa fa-print">  PRINT</i>
                </a>

                <a href="/estimate-mail-pdf/{{$estimate['id']}}" class="btn btn-primary btn-sm" title="mail">
                    {{--                    <i class="fa fa-edit"></i>--}}
                    <i class="fa-solid fa-envelope">  Mail</i>
                    {{--                    <i class="fas fa-briefcase" style="font-size:24px"></i>--}}
                </a>
                <a href="/estimate-download-pdf/{{$estimate['id']}}" class="btn btn-secondary btn-sm" title="download">
                    {{--                    <i class="fa fa-edit"></i>--}}
                    <i class="fa fa-download">  DOWNLOAD</i>
                </a>

            </div>
            <div class="modal-body">
                <div class="modal-element" >
                <?php
                    if (!is_null($estimate->branchId)){
                        $company = \App\Models\Settings\BusinessBranch::where('id','=',$estimate->branchId)->first();
                    }
                    ?>

                    <?php
                    $products = json_decode($estimate['products']);
                    $pdt = \App\Models\Project\ProjectDeal::where('id','=', $estimate->projectId)->first();
                    $client =\App\Models\CRM\Leeds::where('id','=',$estimate->clientId)->first();
//                    $supp = \App\Models\Supplier\Supplier::where('id','=',$purchase->supplierId)->first();
//                    $purId =\App\Models\Purchase\PurchaseType::where('id','=',$purchase->purchaseCategory)->first();
                    ?>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Date:</label>
                        <label class="col-md-6 col-form-label">{{$estimate->date}}</label>

                    </div>
                    <div class="row" style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Project Name:</label>
                        <label class="col-md-6 col-form-label">{{$pdt->projectName}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Project Duration:</label>
                        <label class="col-md-6 col-form-label">{{$pdt->duration}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Client Name</label>
                        <label class="col-md-6 col-form-label">{{$client->clientName}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Branch Name:</label>
                        <label class="col-md-6 col-form-label"><?php if (!is_null($estimate->branchId)) {echo $company->branchName;}; ?></label>
                    </div>
                    <hr style=" border: 1px solid ;">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-6">
                                <span style="font-weight: bold;"> ProductName:</span><span style="color: red; font-weight: bold;">{{$product->product}}</span> <br>
                                <span style="font-weight: bold;"> Quantity:</span><span style="color: red; font-weight: bold;">{{$product->quantity}}</span> <br>
                                <span style="font-weight: bold;"> Rate:</span><span style="color: red; font-weight: bold;">{{$product->unit}}</span><br>
                                <span style="font-weight: bold;"> Price:</span><span style="color: red; font-weight: bold;">{{$product->amount}}</span>
                            </div>
                        @endforeach
                    </div>
                    <hr style=" border: 1px solid ;">
                    <div class="row"style="background-color: orange;" >
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Grand Total:(Including Vat & Discount)</label>
                            <label class="col-form-label">{{$estimate->grandTotal}}</label>
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
