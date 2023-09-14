@extends('master.app')
{{--@section('content')--}}
<style>
    /*.container {*/
    /*    padding: 0 8rem;*/
    /*    width: 80%;*/

    /*}*/

    .headsec {
        display: flex;
        justify-content: space-between;
    }

    .title {
        margin-left: 2rem;
        margin-top: 1rem;

    }

    .rightsec {
        margin-right: 11rem;
        margin-top: 1rem;
    }

    .rightsec h5:first-child {
        margin-bottom: -1rem;
    }

    .rightsec h5:last-child {
        margin-bottom: -1rem;
    }

    .infosec {
        display: flex;
        justify-content: space-between;
    }

    .leftinfo {
        margin-left: 3rem;
        text-align: left;
    }

    .leftinfo h5 {
        /*margin-bottom: -1rem;*/
    }

    .rightinfo {
        margin-right: 10rem;
        text-align: left;
    }

    .rightinfo h5 {
        /*margin-bottom: -1rem;*/
    }

    .dtable {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin-top: 1rem;
        margin-left: 3rem;
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
        margin-left: 4rem;
        margin-top: 3rem;
        text-align: center;
    }
    .rightthird{
        margin-right: 10rem ;
        /*text-align: right;*/
    }
    .rightthird h5{
        /*margin-bottom: -5px;*/
    }
    .footer-txt {
        margin-left: 4rem;
        margin-top: 2rem;
    }
    .confirm{
        width:80%;
        display: flex;
        justify-content: center;
    }
    .buttn{

        width: 8rem;
        display: flex;
        justify-content: center;
    }
    .buttn span{
        font-weight:bold;
        color: white;
        font-size: 20px;
    }
    @media only screen and (max-width: 800px){
        .title{
            padding-right: 3rem;
        }
        .rightsec {
            margin-right: 3rem;

        }
        .rightsec h5{
            margin-top: 1rem;

        }
        .rightinfo {
            margin-right: 0;
        }
        .rightthird{
            margin-right: 6rem ;
            margin-top:3rem;
        }
    }
</style>
@section('content')
<div class="content-wrapper bg-white">
    <div class="row">
        <div class="container">
            <div class="col-lg-12 bg-white mx-auto mt-5">

                <div class="headsec">
                    <div class="title">
                        <h1>Purchase Invoice</h1>
                    </div>

                    <div class="rightsec">
                        <h5>Date:{{$purchases->date}}</h5><br>
                        <h5>Invoice:</h5>
                    </div>
                </div>
                <hr style="border:2px solid; color: dodgerblue;">
                <div class="infosec">
                    <div class="leftinfo">
                        <h5>Bill To:</h5>
                        <h5>{{$leeds->clientName}}</h5>
                        <h5>{{$leeds->email}}</h5>
                        <h5>Address Line</h5>
                        <h5>City/State/Country</h5>
                        <h5>Phone No:{{$leeds->phoneNo}}</h5>
                    </div>
                    <div class="rightinfo">
                        <h5>Ship To:</h5>
                        <h5>{{$suppliers->companyOrStoreName}}</h5>
                        <h5>{{$suppliers->businessAddress}}</h5>
                        <h5>{{$suppliers->email}}</h5>
                        <h5>City/State/Country</h5>
                        <h5>Phone No:{{$suppliers->phoneNo}}</h5>
                    </div>
                </div>
                <br>
                <table class="dtable">
                    <thead style="background-color:dodgerblue;">
                    <tr>
                        <th style="width: 10%">Item</th>
                        <th>About</th>
                        <th style="width: 15%">Quantity</th>
                        <th style="width: 15%">Rate</th>
                        <th style="width: 15%">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="height: 2rem;">
                        <td>adnan</td>
                        <td>adnan</td>
                        <td>adnan</td>
                        <td>adnan</td>
                        <td>adnan</td>

                    </tr>
                    <tr style="height: 2rem;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <?php
                    $products = json_decode($purchases['products']);

                    ?>
                    @foreach($products as $product)
                        <?php
                        $good = \App\Models\Product\Product::where('id','=',$product->productId)->first();
                        ?>
                    <tr>
                        <td>{{$good->productName}}</td>
                        <td>adnan</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->rate}}</td>
                        <td>{{$product->price}}</td>

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
                        <p>If you have any concern regarding this invoice,please contact</p>
                        <p>Name, Phone, Email</p>
                        <h4>Thank You For Your Business</h4>
                    </div>

                    <div class="rightthird" style="text-align: left;">
                        <h5>Sub Total:</h5>
                        <h5>Vat/Tax: static 3%</h5>
                        <h5>Payment:{{$purchases->paid}}</h5>
                        <h5>Due:{{$purchases->grandTotal}}</h5>
                        <h5>Shipping and Handling: not fixed</h5>
                        <h4>Grand Total:{{$purchases->grandTotal}}</h4>

                    </div>
                </div>

                <div class="footer-txt">
                    <p style="margin-bottom: -1rem;">Powered by</p>
                    <p  style="font-style: italic;font-size: 2rem;color:#008000;font-weight: 900;">Orchid Architect's <p>
                </div>
                <div class="confirm">
                <a href="/purchase-pdf/{{$purchases['id']}}" class="btn btn-success buttn" style="margin-bottom: 10rem;"><span>Confirm</span></a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
