<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">

        .firstImage{
            width:30%;
            margin-left: 4rem;
            margin-top:8%;
        }
        .first{
            font-style: italic;
            font-size: 2rem;
            color:#008000;
            font-weight: 900;
            margin-bottom: 0px;
            display:inline;
        }
        .header{
            width:80%;
            display:inline-block;
            height:17%;
            /*display:flex;*/
            /*align-items: center;*/
            /*margin:auto;*/
            /*justify-content: space-between;*/
        }
        .all{
        }
        .second{
            font-family: Arial, Helvetica, sans-serif;
            margin:0;
            width: 50%;
        }
        .secondItem{
            margin-top:30px;
            margin:auto;
            width:80%;
        }
        .thirdPortion{
            width:80%;
            display:inline-block;
            height: 2px;
            font-family: Arial, Helvetica, sans-serif;
            margin-bottom: 3rem;
        }
        .fourthPortion{
            font-family: Arial, Helvetica, sans-serif;
            margin:auto;
            width:80%;
        }
        .line{
            line-height: 12px;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin:auto;
            text-align: left;
            border:1px solid #000000 !important;
        }
        .table-text{
            text-align: center !important;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            text-align: left;
            border:1px solid #000000 !important;
        }

        tr:nth-child(even) {

        }
        .table-secondary{
            background-color: 	#808080;
        }
        .bottom{
            font-family: arial, sans-serif;
            width: 80%;
            margin:auto;
            height: 580px;
        }
        .bottomCenter{
            width:95%;
            height:480px;
            margin:auto;
            display:inline-block;
            margin-bottom: 5px;
        }
        .orchid{
            width:800px;
            display:inline-block;
            height:150px;
        }
        .footer{
            font-family: arial, sans-serif;
            width:80%;
            margin:auto;
            text-align: center;
            /*line-height: 4px;*/
            font-size: 15px;
            font-weight: 500;
        }
        th td{
            text-align: center;
        }
        .th1 {
            border: 1px solid #dddddd;
            background-color: grey;
            padding: 8px;
        }
        .red{
            color:red;
        }
        span.a {
            display: inline; /* the default for span */
            width: 400px;
            height: 10px;
            /*padding: 5px;*/
            margin-right: 90px;
        }
        span.b {
            width: 100px;
            height: 1rem;
            float:right;
            margin-right: 6rem;
        }
        span.c {
            display: inline; /* the default for span */
            width: 600px;
            height: 10px;
            float:left;
            /*padding: 5px;*/
            /*margin-right: 2px;*/
        }
        span.d {
            width: 200px;
            height: 200px;
            float:right;
            margin-right: 7rem;
            margin-top:46px;
        }
        span.x {
            display: inline; /* the default for span */
            width: 10px;
            height: 2px;
            float:left;
            margin-left: 4.5rem;
            /*padding: 5px;*/
            /*margin-right: 2px;*/
        }
        span.y {
            width: 10px;
            height: 3px;
            float:right;
            margin-right: 4.5rem;
        }
        .s2{
            margin-bottom: 2px !important;
        }
        .new2{
            height: 335px;
            display:inline-block;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<div class="container all">
    <div class="row">
        <div class="header-1" style="height:130px;">
            <div class="pad-logo" style="float:left;width: 60%;margin-left: 5%;margin-top: 4%;height: 100px"><img class="firstImage" src="{{base_path()}}/public/orchid.png"></div>
            <div style="float:right;width: 40%;margin-right: 9%;">
                <p style="font-style: italic;font-size: 2rem;color:#008000;font-weight: 900;margin-bottom: 0px;">Orchid Architect's <p>
                    <span>Architect,English,Landscape,Interior & Exterior Consultancy.</span>
            </div>
        </div>
{{--        <div class="header">--}}
{{--            <span class="a"></span>--}}
{{--            <span class="b">--}}
{{--                <p class="first">Orchid Architect's <p>--}}
{{--                <span class="second">Architect,English,Landscape,Interior & Exterior Consultancy.</span>--}}
{{--            </span>--}}
{{--        </div>--}}
        <div class="secondItem">
            <hr  style = 'background-color:#32CD32; opacity:1 !important; border-width:0; color:#000000; height:2px; lineheight:0; width:100%; margin-bottom:0px !important;'>
            <hr  style = 'background-color:#000000; opacity:1 !important; margin-top:1.5px !important; border-width:0; color:#000000; height:2px; lineheight:0; display: inline-block; text-align: left; width:100%;'>
        </div>
        <div class="thirdPortion" >
            <span class="x">
                Ref:
            </span>
            <span class="y">
                         Date:
            </span>


        </div>
        <div class="fourthPortion">
            <div class="line">
                <p>Date: {!! date('d M y', strtotime($quotes->created_at)) !!}</p>
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
        <table >
            <thead >
            <tr >
                <th class="th1">#</th>
                <th class="th1 table-text">Description</th>
                <th class="th1">Qty</th>
                <th class="th1">Length</th>
                <th class="th1">Width</th>
                <th class="th1">Height</th>
                <th class="th1">Rate</th>
                <th class="th1">Total Amount</th>
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
                    <th class="red table-text">{{$houseType->name}}</th>
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
                    <tr >
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$decorType->name}}</td>
                        <td>{{$info->selectedQty}}</td>
                        <td><?php echo ($info->length === 0)? 'empty': $info->length  ?></td>
                        <td><?php echo ($info->width === 0)? 'empty': $info->width  ?></td>
                        <td><?php echo ($info->height === 0)? 'empty': $info->height  ?></td>
                        <td>{{$info->selectedRate}}</td>
                        <td>{{$info->line_total}}</td>
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
            <tr>
                <th></th>
                <th class="">Grand Total amount</th>
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
            <div class="new2">
                <?php
                $f = new NumberFormatter("en_EN", NumberFormatter::SPELLOUT);
                ?>
            <p style="font-weight: 900;font-size: 24px" class="page-break"><b>In word: {{ucwords(trans($f->format($quotes->grandTotal)))}} Taka Only</b></p>
            <div class="bottomCenter">
                <p style="font-weight: 900;font-size: 19px;margin-left: 2rem;"><b>Terms and conditions for payment schedule:</b></p>
                <div style="margin-left: 4rem;width:450px">
                    <p>>> 40% payment to be made along with confirmed word order.</p>
                    <p>>> 50% payment to be made along with confirmed word order.</p>
                    <p>>> 60% payment to be made along with confirmed word order.</p>
                </div>
                <p style="margin-bottom: 0px"> Duration of word completion: .....working days</p>
                <p style="margin-bottom: 0px">Please call us for any sort of inquires</p>
                <p>Thanks and best ragards</p>
                </div>
            </div>
            <div class=" orchid">
                    <span class="c">
                        <p style="height: 3rem"></p>
                        <p style="border-top: 2px solid black; width:11.4rem;" ></p>
                        <p style="margin-left: 1rem;width:15rem">Orchid Architect's<br>
                            Chief Executive Officer</p>
                    </span>
                <span class="d" >
                        <p style="height: 3px;width:100px"></p>
                        <p style="border-bottom: 2px solid black; width:55px;" ></p>
                        <p>Client</p>
                    </span>
            </div>
            </div>
            <hr  style = 'background-color:#32CD32; opacity:1 !important; border-width:0; color:#000000; height:2px; lineheight:0; width:80%; margin-bottom:0px !important;'>
            <hr  style = 'background-color:#000000; opacity:1 !important; margin-top:1px !important; border-width:0; color:#000000; height:2px; lineheight:0;  width:80%;'>
            <div class="footer">
                <p>House # 252/1/A, West Monipur Barek Mollar Mor,60'Road,Mirpur-2 Dhaka-121 </p>
                <p>Cell:01738-573747,01748-747651,Phone:02-55077910 E-mail:orchidarch.bd@gmail.com</p>
                <p style="letter-spacing: 3px"> www.orchidarchitect.com</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>





