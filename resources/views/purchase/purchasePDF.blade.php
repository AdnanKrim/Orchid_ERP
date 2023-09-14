{{--@extends('master.app')--}}
<style>
    .container {
        padding-left: 4rem;
        width: 80%;

    }

    .headsec {
        display: flex;
        justify-content: space-between;
    }

    .title {
        margin-left: 8rem;
        margin-top: 1rem;

    }

    .rightsec {
        margin-left: 28rem;
        margin-top: -5rem;
    }

    /*.rightsec h5:first-child {*/
    /*    margin-bottom: -3rem;*/
    /*}*/

    .rightsec h5:last-child {
        margin-bottom: -1rem;
        margin-top: -2rem;
    }

    .infosec {
        display: flex;
        justify-content: space-between;
    }

    .leftinfo {
        margin-left: 1rem;
        text-align: left;
    }

    .leftinfo h5 {
        margin-bottom: -1rem;
    }

    .rightinfo {
        margin-left: 28rem;
        margin-top: -10rem;
        text-align: left;
    }

    .rightinfo h5 {
        margin-bottom: -1rem;
    }

    .dtable {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 3rem;
        margin-left: 1rem;
        text-align: left;
        border: 1px solid #000000 !important;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        text-align: left;
        border: 1px solid #000000 !important;
    }
    .thirdsec{
        display: flex;
        justify-content: space-between;
    }
     .leftthird{
         margin-left: 1rem;
         margin-top: 2rem;
         text-align: left;
     }
     .rightthird{
         margin-left: 25rem ;
         margin-top: -12rem;
         text-align: left;
     }
     .rightthird h5{
         margin-bottom: -5px;
     }
     .footer-txt{
         margin-left: 1rem;
         margin-top: -4rem;
     }
    .footer-txt p{
        margin-bottom: -2rem;
    }

</style>
{{--@section('content')--}}
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="container">
            <div class="col-lg-12 bg-white mx-auto mt-5">

                <div class="headsec">
                    <div class="title">
                        <h1 >Purchase Proposal</h1>
                    </div>

{{--                    <div class="rightsec">--}}
{{--                        <h5>Date:{{$purchases->date}}</h5><br>--}}
{{--                        <h5>Invoice:</h5>--}}
{{--                    </div>--}}
                </div>
                <?php
                $count = \App\Models\Purchase\purchase::where('clientId',$purchases->clientId)->count();
                ?>
                <hr style="border:2px solid; margin-top: 2rem; color: dodgerblue;">
                <div class="infosec">
                    <div class="leftinfo">
                        <h5>Date:{{$purchases->date}}</h5>
{{--                        <h5>{{$leeds->clientName}}</h5>--}}
{{--                        <h5>{{$leeds->email}}</h5>--}}
                        <h5>Invoice No:</h5>
{{--                        <h5>City/State/Country</h5>--}}
{{--                        <h5>Phone No:{{$leeds->phoneNo}}</h5>--}}
                        <h5>Proposal Count Time: <h3>{{$count}}</h3></h5>
                    </div>
                    <div class="rightinfo">
{{--                        <h5>Ship To:</h5>--}}
                        <h5>Under Client:{{$leeds->clientName}}</h5>
{{--                        <h5>{{$suppliers->businessAddress}}</h5>--}}
{{--                        <h5>{{$suppliers->email}}</h5>--}}
                        <h5>Phone No:{{$leeds->phoneNo}}</h5>
                        <h5> Address:{{$leeds->address}}</h5>
                    </div>
                </div>
                <br>
                <table class="dtable">
                    <thead style="background-color:dodgerblue;">
                    <tr>
                        <th style="width: 10%">Item</th>
                        <th style="width: 10%">Quantity</th>
                        <th style="width: 10%">Unit</th>
                        <th style="width: 10%">Rate</th>
                        <th style="width: 15%">Price</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    <tr style="height: 2rem;">--}}
{{--                        <td>adnan</td>--}}
{{--                        <td>adnan</td>--}}
{{--                        <td>adnan</td>--}}
{{--                        <td>adnan</td>--}}
{{--                        <td>adnan</td>--}}

{{--                    </tr>--}}
                    <tr style="height: 2rem;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <?php
                    $products = json_decode($purchases['products']);
                    $total = 0;
                    ?>
                    @foreach($products as $product)
                        <?php
                        $good = \App\Models\Product\Product::where('id','=',$product->productId)->first();
                        ?>
                        <?php
                        if (!is_null($good->unitId)){
                            $unit = \App\Models\Product\Unit::where('id','=',$good->unitId)->first();
                        }

                        ?>

                        <tr>
                            <td>{{$good->productName}}</td>
                            <td>{{$product->quantity}}</td>
                            <td><?php if (!is_null($good->unitId)) {echo $unit->uniteName;}; ?></td>
                            <td>{{$product->rate}}</td>
                            <td>{{$product->price}}</td>
                            <?php
                            $total += $product->price
                            ?>

                        </tr>
                    @endforeach
                    <tr style="height: 2rem;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    </tbody>
                </table>
                <div class="thirdsec">
                    <div class="leftthird">
                        <p>If you have any concern regarding this invoice,<br>please contact</p>
                        <p>Name, Phone, Email</p>
                        <h4>Thank You For Your Business</h4>
                    </div>
                    <div class="rightthird">
                        <h5>Sub Total: {{$total}}</h5>
                        <h5>Vat/Tax: static 3%</h5>
                        <h4>Grand Total:{{$purchases->grandTotal}}</h4>
                        <h5>Shipping and Handling: not fixed</h5>
                        <h5>Payment:{{$purchases->paid}}</h5>
                        <h4>Due:{{$purchases->due}}</h4>

                    </div>
                </div>
                <div class="footer-txt" style=" margin-top: 2rem;">
                    <hr style="border:1px solid; margin-top: 2rem; color:black; width: 30%; margin-left: -0.5rem;">
                    <p style="margin-left: -8px;">Orchid Authorized Signature</p>
{{--                    <p style="font-style: italic;font-size: 2rem;color:#008000;font-weight: 900;margin-bottom: 0px;">Orchid Architect's <p>--}}

                </div>

            </div>
        </div>

    </div>
</div>
{{--@endsection--}}
