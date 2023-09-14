@extends('master.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">

        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Add Purchase </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Purchase Category<span style='color: #ff0000;'>*</span></label>
                                            <input type="text" class="form-control" v-model="purchaseCategory" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>User Name<span style='color: #ff0000;'>*</span></label>
{{--                                            <select id="state" class="form-control select2 bg-white" name="userId"  >--}}
{{--                                                <option value="" selected>select product</option>--}}
{{--                                                @foreach($users as $user)--}}
{{--                                                    <option value="{{$user->id}}">{{$product->UserName}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
                                            <input type="text" class="form-control" v-model="userId"  />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Client Name<span style='color: #ff0000;'>*</span></label>
                                            <select id="state" class="form-control select2 bg-white" v-model="clientId"  >
                                                <option value="" selected>select clients</option>

                                                    <option value=""></option>

                                            </select>
{{--                                            <input type="text" class="form-control" v-model="clientId" />--}}
                                        </div>
                                        <div class="col-md-6">
                                            <label>Supplier Name<span style='color: #ff0000;'>*</span></label>
                                            <select id="state" class="form-control select2 bg-white" v-model="supplierId"  >
                                                <option value="" selected>select suppliers</option>
                                                    <option value=""></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" v-for="key in count" :key="key">
                                        <div class="col-md-3">
                                            <label>Product Id<span style='color: #ff0000;'>*</span></label>
                                            <select id="state" class="form-control select2 bg-white" v-model="products.rows['productId' +key]" :id="key" >
                                                <option value="" selected>select product</option>
                                                    <option v-for="good in goods" :value="good.id">

                                                    </option>

                                            </select>
{{--                                            <input type="text" class="form-control" v-model="values['productId'+key]" :id="key" />--}}
                                        </div>
                                        <div class="col-md-2">
                                            <label>Quantity<span style='color: #ff0000;'>*</span></label>
                                            <input type="text" class="form-control" v-model="products.rows['quantity' +key]" :id="key" />
                                        </div>

                                        <div class="col-md-2">
                                            <label>Rate<span style='color: #ff0000;'>*</span></label>
                                            <input type="text" class="form-control" v-model="products.rows['rate'+key]" :id="key" />
                                        </div>
                                        <div class="col-md-3">
                                            <label>Price<span style='color: #ff0000;'>*</span></label>
                                            <input type="text" class="form-control" v-model="products.rows['price' +key]" :id="key" />
                                        </div>
                                        <div class="col-md-2">
                                            <label>Add Fields</label><br>
                                            <a href="#" class="btn btn-success btn-sm" @click="add" title="add" id="add_more_fields">
                                                <i class="fa fa-plus-circle"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm" @click="remove" title="remove">
                                                <i class="fa fa-minus-circle"></i>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Grand Total<span style='color: #ff0000;'>*</span></label>
                                            <input type="text" class="form-control" v-model="grandTotal" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Due</label>
                                            <input type="text" class="form-control" v-model="due" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Date<span style='color: #ff0000;'>*</span></label>
                                            <input type="date" class="form-control" v-model="date" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Payment</label>
                                            <input type="text" class="form-control" v-model="paid" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Status</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" v-model="status" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" v-on:click="submit" value="Submit" />
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
    <script src="https://unpkg.com/vue@3"></script>{{}}

    <script>
        // window.axios = require('axios');
        // window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        const {
            createApp
        } = Vue

        createApp({
            data: function() {
                return {
                        count: 1,
                        values: {},
                         goods:null,
                        suppliers: null,
                        clients:null,
                        peoples:null,

                        purchaseCategory: '',
                        userId: '',
                        clientId: '',
                        supplierId: '',
                        products: {
                            rows: [{
                                productId: 'select product',
                                quantity: '',
                                rate: '',
                                price: '',
                            }],
                        },
                        grandTotal: '',
                        due: '',
                        date: '',
                        paid: '',
                        status: ''


                }
            },
            methods: {
                add: function() {
                    this.count++;
                },
                remove: function() {
                    this.count--;
                },
                submit:function (){
                 console.log("submit",this.purchaseCategory);
                }
            },
            mounted() {
                axios.get('api/table-data').then( response=>{
                    this.goods = response.data.data;
                })
            }
        }).mount('#app')
    </script>

    <!-- /.content-wrapper -->

@endsection




