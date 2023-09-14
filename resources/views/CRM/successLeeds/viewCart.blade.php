@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <div class="container all">
                <div class="row">
                    {{--      Header Section Start--}}
                    <div class="buttontop">

{{--                            <p></p>--}}
{{--                        </div>--}}
{{--                        <div>--}}
                       <a class="btn btn-success text-light mt-2 ml-1" href="{{route('view-pdf', ['id'=>$leed->id, 'qId'=>$quotes->id])}}">Print</a>
                       <a class="btn btn-success text-light mt-2 ml-1" href="{{route('download-pdf', ['id'=>$leed->id, 'qId'=>$quotes->id])}}">Download</a>
                       <a class="btn btn-success text-light mt-2 ml-1" href="{{route('mail-pdf', ['id'=>$leed->id, 'qId'=>$quotes->id])}}">Mail</a>
{{--                        </div>--}}

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
                            <p><b>Subject: {{$quotes->subject}} </b></p>
                            <p >Honorabel Sir;</p>
                        </div>
                        <p >
                            {{$quotes->body}}
                        </p>
                    </div>
                    <table class="table table-bordered mb-2">
                        <thead class="text-center">
                        <tr class="table-secondary">
                            <th>#</th>
                            <th class="text-center">Description</th>
                            <th>Unit</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Qty</th>
                            <th>Rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carts as $cart)
                            <?php
                            $cartInfo = json_decode($cart['houseAreaCartInfo']);
                            $houseType = \App\Models\CRM\HouseAreaType::find($cart->houseAreaTypeId);
                            ?>
                                <tr class="">
                                    <td></td>
                                    <th class="text-center text-danger col-md-8">{{$houseType->name}}</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                    @foreach($cartInfo as $info)
                                        <?php
                                        $decorType = \App\Models\CRM\DecorationType::find($info->selectedDecor);
                                        ?>
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$decorType->name}}</td>
                                    <td>{{$info->selectedUnit}}</td>
                                    <td><?php echo ($info->length === 0)? 'empty': $info->length  ?></td>
                                    <td><?php echo ($info->width === 0)? 'empty': $info->width  ?></td>
                                    <td><?php echo ($info->height === 0)? 'empty': $info->height  ?></td>
                                    <td>{{$info->selectedQty}}</td>
                                    <td>{{$info->selectedRate}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>{{$info->selectedDes}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach
                                <tr>
                                    <th></th>
                                    <th>Total Amount</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td>{{$quotes->totalAmount}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Vat</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td>{{$quotes->totalVat}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Discount</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td>{{$quotes->discount}}</td>
                                </tr>
                        <?php
                            $f = new NumberFormatter("en_EN", NumberFormatter::SPELLOUT);
                        ?>
                                <tr>
                                    <th></th>
                                    <th class="text-bold">Grand Total amount</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td>{{$quotes->grandTotal}}</td>
                                </tr>
                        </tbody>
                    </table>
                    <div class="bottom">
                        <p style="font-weight: 900;font-size: 24px"><b>In word: {{ucwords(trans($f->format($quotes->grandTotal)))}} Taka Only</b></p>
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
