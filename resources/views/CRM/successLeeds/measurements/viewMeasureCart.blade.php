@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <div class="container all">
                <div class="row">
                    {{--      Header Section Start--}}
                    <div class="buttontop">

                        <a class="btn btn-success text-light mt-2 ml-1" href="{{route('view-measure-pdf', ['id'=>$leed->id, 'mId'=>$measure->id])}}">Print</a>
                        <a class="btn btn-success text-light mt-2 ml-1" href="{{route('download-measure-pdf', ['id'=>$leed->id, 'mId'=>$measure->id])}}">Download</a>
                        <a class="btn btn-success text-light mt-2 ml-1" href="{{route('mail-measure-pdf', ['id'=>$leed->id, 'mId'=>$measure->id])}}">Mail</a>

                    </div>
                    <div class="header">
                        <div><img class="firstImage" src="{{asset('orchid.png')}}"></div>
                        <div class="h2">
                            <p class="first">Orchid Architect's <p>
                            <p class="second">  Architect,English,Landscape,Interior & Exterior Consultancy.
                            </p>
                        </div>
                    </div>
                    <div class="secondItem">
                        <hr  style = 'background-color:#32CD32; opacity:1 !important; border-width:0; color:#000000; height:2px; lineheight:0; width:100%; margin-bottom:1.5px !important;'>
                        <hr  style = 'background-color:#000000; opacity:1 !important; margin-top:0px !important; border-width:0; color:#000000; height:2px; lineheight:0; display: inline-block; text-align: left; width:100%;'>
                    </div>
                    <div class="thirdPortion">
                        <p style="margin-left:4rem;">
                            Ref<span class="mx-1">:</span>

                        </p>
                        <p style="margin-right:4rem;">Date<span class="mx-1">:</span>  </p>
                    </div>
                    <div class="fourthPortion">
                        <div class="line">
                            <p>Date:  Wednesday,24 March 2021</p>
                            <p>To</p>
                            <p ><b>Company Name: {{$leed->clientName}}</b></p>
                            <p>Contact: {{$leed->email}}</p>
                            <p><b>Mobile: {{$leed->phoneNo}}</b></p>
                        </div>
                    </div>
                    <table class="table table-bordered mb-2">
                        <thead class="text-center">
                        <tr class="table-secondary">
                            <th>#</th>
                            <th class="text-center  col-md-4">Description</th>
                            <th>StructureNos</th>
                            <th>Length(ft)</th>
                            <th>Width(ft)</th>
                            <th>Height(ft)</th>
                            <th>Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($measureCarts as $mc)
                            <?php
                            $cartInfo = json_decode($mc['measurementCartInfo']);
                            $measureType = \App\Models\CRM\Measurement\MeasurementType::find($mc->measurementTypeId);
                            ?>
                            <tr class="">
                                <td></td>
                                <th class="text-danger">{{$measureType->measurementTypeName}}</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($cartInfo as $info)
                                <?php
                                    $measureStruct = \App\Models\CRM\Measurement\MeasurementStructureType::find($info->selectedStructure);
                                ?>
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td class="text-center">{{$measureStruct->measurementStructureName}}</td>
                                    <td>{{$info->selectedStructNo}}</td>
                                    <td>{{$info->selectedLength}}</td>
                                    <td>{{$info->selectedWidth}}</td>
                                    <td>{{$info->selectedHeight}}</td>
                                    <td>{{$info->selectedQty}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td class="text-bold text-center">Total</td>
                                <td>{{$mc->totalQty}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="9" class="text-center bg-gray-light">Bill Sheet</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Item Description</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                        </tr>
                        @foreach($measureCarts as $mc)
                            <?php
                            $cartInfo = json_decode($mc['measurementCartInfo']);
                            $measureType = \App\Models\CRM\Measurement\MeasurementType::find($mc->measurementTypeId);
                            ?>
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$measureType->measurementTypeName}}</td>
                                <td>{{$measureType->unit}}</td>
                                <td>{{$mc->totalQty}}</td>
                                <td>{{$measureType->rate}}</td>
                                <td>{{$mc->totalAmount}}</td>
                                <td>Remarks</td>
                            </tr>
                        @endforeach
                        @foreach($childless as $cl)
                            <?php
                            $cartInfo = json_decode($cl['measurementCartInfo']);
                            if (!is_null($cl->measurementTypeId)){
                                $measureType = \App\Models\CRM\Measurement\MeasurementType::find($cl->measurementTypeId);
                            }
                            ?>
                            @if(!is_null($cl->measurementTypeId))
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$measureType->measurementTypeName}}</td>
                            <td>{{$measureType->unit}}</td>
                            <td>{{$cartInfo->selectedQty}}</td>
                            <td>{{$measureType->rate}}</td>
                            <td>{{$cl->totalAmount}}</td>
                            <td>Remarks</td>
                        </tr>
                            @endif
                        @endforeach
                        <tr>
                            <th></th>
                            <th>Total Amount</th>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td>{{$measure->totalAmount}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Vat</th>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td>{{$measure->vat}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Discount</th>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td>{{$measure->discount}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th class="text-bold">Grand Total amount</th>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td>{{$measure->grandTotal}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Advanced</th>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td>{{$measure->advanced}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th colspan="4" class="text-center text-danger">Total Payable Amount</th>
                            <td colspan="2" class="text-bold text-center bg-gray-light">{{$measure->totalPayableAmount}}</td>
                        </tr>
                        <?php
                        $f = new NumberFormatter("en_EN", NumberFormatter::SPELLOUT);
                        ?>
                        </tbody>
                    </table>
                    <div class="bottom">
                        <p style="font-weight: 900;font-size: 24px"><b>In word: {{ucwords(trans($f->format($measure->totalPayableAmount)))}} Taka Only</b></p>
                        <div class="bottomCenter">
                            <p style="font-weight: 900;font-size: 19px;margin-left: 2rem;"><b>Terms and conditions for payment schedule:</b></p>
                            <div style="margin-left: 7rem;">
                                <p>&#8667; 40% payment to be made along with confirmed word order.</p>
                                <p>&#8667; 50% payment to be made along with confirmed word order.</p>
                                <p >&#8667; 60% payment to be made along with confirmed word order.</p>
                            </div>
                            <p style="margin-bottom: 0px"> Duration of word completion: .....working days</p>
                            <p style="margin-bottom: 0px">Please call us for any sort of inquires</p>
                            <p>Thanks and best ragards</p>
                            <div class=" orchid">
                                <div>
                                    <p style="height: 3rem"></p>
                                    <p style="border-top: 2px solid black; width:7rem;" class="mt-3"></p>
                                    <p>Orchid Architect's<br>
                                        Chief Executive Officer</p>
                                </div>
                                <div>
                                    <p style="height: 3rem"></p>
                                    <p style="border-bottom: 2px solid black; width:7rem;" class="mt-3"></p>
                                    <p>Client</p>
                                </div>
                            </div>
                        </div>
                        <hr  style = 'background-color:#32CD32; opacity:1 !important; border-width:0; color:#000000; height:2px; lineheight:0; width:100%; margin-bottom:0px !important;'>
                        <hr  style = 'background-color:#000000; opacity:1 !important; margin-top:1px !important; border-width:0; color:#000000; height:2px; lineheight:0; display: inline-block; text-align: left; width:100%;'>
                        <div class="footer">
                            <p >House # 252/1/A, West Monipur Barek Mollar Mor,60'Road,Mirpur-2 Dhaka-1216</p>
                            <p >Cell:01738-573747,01748-747651,Phone:02-55077910 E-mail:orchidarch.bd@gmail.com</p>
                            <p style="letter-spacing: 3px"> www.orchidarchitect.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function create()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'New Company Information Added Successfully'
            })
        }
        function wise_words()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Company Information Deleted Successfully'
            })
        }
        function update()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Company Information Updated Successfully'
            })
        }
    </script>
@endsection
