<template>
    <form @submit.prevent="submit()">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Date</label>
                <input  type="date" class="form-control" name="date" v-model="date" />
            </div>
            <div class="col-md-6">
                <label>Purchase Invoice No:</label>
                <input readonly type="text" class="form-control" name="purchase" v-model="purchase" />
            </div>

        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label>Supplier Name</label>
                <input readonly type="text" class="form-control" name="supplierId" v-model="supplierName" />
            </div>
            <div class="col-md-4">
                <label>Client Name</label>
                <input readonly type="text" class="form-control" name="clientId" v-model="clientCall" />
            </div>
            <div class="col-md-4">
                <label>Project Name</label>
                <input readonly type="text" class="form-control" name="projectId" v-model="projectName" />
            </div>

        </div>
        <div  class="form-group row" v-for="(key, keyIndex) in products"  :key="key.id">

            <div class="col-md-2" >
                <label v-if="keyIndex == 0">Product<span style='color: #ff0000;'>*</span></label>
                <select id="yt" class="form-control select2 bg-white" name="productTypeId[][id]" v-model="key.productId" @change="getUnit(keyIndex)" >
                    <option value="" selected>select product</option>
                    <option v-for="good in goods" :value="good.id" :selected="key.productId === good.id" >{{good.productName}}</option>
                </select>
            </div>

            <div class="col-md-1" >
                <label v-if="keyIndex == 0">Unit</label>
                <input readonly type="text" class="form-control" v-model="key.unit" />
            </div>

            <div class="col-md-2" >
                <label v-if="keyIndex == 0">Returned Qty</label>
                <input type="number" class="form-control" name="quantity" v-model="key.quantityReturn"  @change="calculateRowTotal(keyIndex)" />
            </div>


            <div class="col-md-2" >
                <label v-if="keyIndex == 0">Available Qty</label>
                <input readonly type="number" class="form-control" name="quantity" v-model="key.quantity"  @change="calculateRowTotal(keyIndex)" />
            </div>


            <div class="col-md-2" >
                <label v-if="keyIndex == 0">Rate</label>
                <input readonly type="text" class="form-control" name="rate" v-model="key.rate"  @change="calculateRowTotal(keyIndex)" />
            </div>
            <div class="col-md-2" >
                <label v-if="keyIndex == 0">Price</label>
                <input readonly type="number" min="0" step=".01" class="form-control" name="price" v-model="key.price" />
            </div>
            <div class="col-md-1">
                <!--                <label  class="row" v-if="keyIndex == 0"></label><br>-->
                <br v-if="keyIndex===0">
                <button  class="btn btn-success btn-sm mt-2 ml-2 " style="margin-bottom: 0;" v-if="keyIndex == Object.keys(products).length -1" @click="add" title="add" id="add_more_fields">
                    <i class="fa fa-plus-circle"></i>
                </button>
                <button  class="btn btn-danger btn-sm mt-2 ml-2" v-if="keyIndex >> 0" @click="remove"  title="remove">
                    <i class="fa fa-minus-circle"></i>
                </button>
            </div>

        </div>
        <div class="form-group row" >
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <label>Sub Total</label>
                <input readonly type="number" class="form-control" name="subTotal" v-model="subTotal"  />
            </div>

        </div>
        <div class="form-group row" >
            <div class="col-md-4">

            </div>
            <div class="col-md-2" >
                <label>Discount Type</label>
                <select class="form-select"  v-model="discountType" @change="calculateGrandTotal()" >
                    <option>Percentage</option>
                    <option>Amount</option>
                </select>
            </div>
            <div class="col-md-3" >
                <div v-if="discInput === true">
                    <label>Discount(%)</label>
                    <input type="text" class="form-control" v-model="discount" list="discount" @change="calculateGrandTotal()" />
                    <datalist id="discount" >
                        <option value="5%">5%</option>
                        <option value="10%">10%</option>
                        <option value="15%">15%</option>
                        <option value="20%">20%</option>
                        <option value="25%">25%</option>
                        <option value="30%">30%</option>
                        <option value="35%">35%</option>
                        <option value="40%">40%</option>
                        <option value="45%">45%</option>
                        <option value="50%">50%</option>
                    </datalist>
                </div>
                <div v-else>
                    <label>Discount(Amt)</label>
                    <input type="text" class="form-control" v-model="discount" @change="calculateGrandTotal()"  />
                </div>
            </div>


            <div class="col-md-3">
                <label>Discount Amount</label>
                <input readonly type="number" class="form-control" v-model="discAmount"  />
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-6">

            </div>
            <div class="col-md-3">
                <label>Vat(%)</label>
                <input  type="text" class="form-control" list="vat" v-model="vat" @change="calculateGrandTotal()" />
                <datalist id="vat" >
                    <option value="5%">5%</option>
                    <option value="10%">10%</option>
                    <option value="15%">15%</option>
                    <option value="20%">20%</option>
                    <option value="25%">25%</option>
                    <option value="30%">30%</option>
                    <option value="35%">35%</option>
                    <option value="40%">40%</option>
                    <option value="45%">45%</option>
                    <option value="50%">50%</option>
                </datalist>
            </div>
            <div class="col-md-3">
                <label>Vat Amount</label>
                <input readonly type="number" class="form-control" v-model="vatAmount"  />
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <label>Shipping Charge</label>
                <input  type="number" class="form-control" name="grandTotal" v-model="shipment" @change="calculateGrandTotal()"/>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <label>Grand Total</label>
                <input readonly type="text" class="form-control" name="grandTotal" v-model="grandTotal" @click="calculateGrandTotal()"/>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <label>Payment</label>
                <input type="number" class="form-control" name="paid"  v-model="paid" @change="calculateGrandTotal()" />
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-6">
                <!--                <label>status</label>-->
                <input readonly type="hidden" class="form-control"   v-model="status"  />
            </div>

            <div class="col-md-6">
                <label>Due</label>
                <input readonly type="number" class="form-control" name="due"  v-model="due" @change="getPaymentStatus()" />
            </div>
        </div>
        <input readonly type="hidden" class="form-control"   v-model="paymentStatus"  />
        <div class="form-group row">
            <label class="col-md-4 col-form-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-success"  value="Submit" />
            </div>
        </div>
    </form>

</template>
<script type="module">
export default {
    data(){
        return{
            errors:[],
            count:1,
            users:{},
            goods:[{
                productName: '',
            }],

            projects:[{
                projectName: '',
            }],
            suppliers:[{
                companyOrStoreName: ''
            }],
            clients:[{
                clientName: '',
            }],
            purchaseTypes:[{
                purchaseType: '',
            }],
            purchaseCategory: '',
            branch:'',
            userId: '',
            clientId:'',
            clientCall:'',
            supplierName:'',
            supplierId:'',
            owner:'',
            phoneNo:'',
            purchase:'',
            projectName:'',
            projectId:'',
            phone:'',
            products: [{
                product: [],
                productId: 'select product',
                unit:0,
                quantity: '',
                quantityReturn:'',
                rate: '',
                price:0,
            }],
            lineTotal:0,
            allTotal:0,
            subTotal:0,
            shipment:0,
            grandTotal:0,
            due: 0,
            date: '',
            paid: 0,
            paymentStatus:[],
            status: 0,
            discAmount:0,
            vatAmount:0,
            discount:0,
            discountType:'Percentage',
            discInput:true,
            vat:0,
            unitId:0,
            userName:'',
            uniteName:'',
            uniteShort:'',
            ownerName:'',
            id:{},
            idy:{},

            description:'',
        }
    },
    methods:{

        getProduct(){
            axios.get("/api/product-data").then((response)=>{
                this.goods = response.data;
            });
            this.getPurchaseReturnId();

        },
        getPurchaseReturnId(){
            this.idy = window.location.href.split('/').pop();
            console.log(this.idy);
            this.getFormData();
            this.getFormSupp();
            this.getFormClient();
            this.getFormProject();
            this.getFormProduct();
        },
        getFormData(keyIndex){
            axios.get( '/api/prefill-data',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.purchase = response.data.purchaseId;
                    console.log(this.purchase);
                }.bind(this)
            );

        },
        getFormSupp(){
            axios.get( '/api/prefill-sup',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.supplierName = response.data.companyOrStoreName;
                    this.supplierId = response.data.id;

                    // this.supplierId = response.data.companyOrStoreName;
                }.bind(this)
            );


        },
        getFormClient(){
            axios.get( '/api/prefill-client',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.clientCall = response.data.clientName;
                    this.clientId = response.data.id;
                    // this.supplierId = response.data.companyOrStoreName;
                }.bind(this)
            );


        },
        getFormProject(){
            axios.get( '/api/prefill-project',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.projectName = response.data.projectName;
                    this.projectId = response.data.id;
                    // this.supplierId = response.data.companyOrStoreName;
                }.bind(this)
            );


        },
        getFormProduct(){
            axios.get( '/api/prefill-product',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.products = response.data;
                    console.log(response.data);

                    // this.supplierId = response.data.companyOrStoreName;
                }.bind(this)

            );


        },


        add: function() {
            // this.products++;
            this.products.push({
                product: "",
                productId: 'select product',
                unit:0,
                quantity: '',
                rate: '',
                price: '',
            });
            localStorage.setItem("products", JSON.stringify(this.products));
        },
        remove: function(index,key) {
            // this.products--;
            var idx = this.products.indexOf(key);
            console.log(idx, index);
            if (index != 1) {
                this.products.splice(idx, 1);
                localStorage.setItem("products", JSON.stringify(this.products));
            }
            this.calculateTotal();
        },
        calculateRowTotal(keyIndex){
            var total = parseFloat(this.products[keyIndex].quantityReturn)* parseFloat(this.products[keyIndex].rate);
            if (!isNaN(total)) {
                this.products[keyIndex].price = total.toFixed(2);
            }
            this.calculateTotal();
        },
        calculateTotal(keyIndex){
            var lineTotal=0;

            // for (let keyIndex = 0; keyIndex < this.products.length; keyIndex++) {
            //
            // }
            lineTotal= this.products.reduce(function (a,b){
                var rowTotal = parseFloat(b.price);
                return a + rowTotal;
            },0);
            console.log(lineTotal);
            this.subTotal = lineTotal.toFixed(2);
            this.calculateGrandTotal();
        },
        calculateGrandTotal() {
            var discount = 0;
            var amount = 0;
            var vat = 0;
            var dueAmount = 0;
            var finalAmount = 0;
            var char1 = '%'
            // amount = this.subTotal - discount;



            // if (this.discount != 0) {
            //     if (this.discount.includes(char1)) {
            //         discount = this.subTotal * (parseFloat(this.discount) / 100);
            //     } else {
            //         discount = this.discount;
            //     }
            // }
            if (this.discInput === true ) {
                discount = this.subTotal * (parseFloat(this.discount) / 100);
            } else {
                discount = this.discount;
            }


            this.discAmount = discount;
            amount = this.subTotal - this.discAmount;
            if (this.vat != 0) {

                // if (this.vat.includes(char1)) {
                //     vat = this.subTotal * (parseFloat(this.vat) / 100);
                // } else {
                //     vat = parseInt(this.vat);
                // }
                vat = this.subTotal * (parseFloat(this.vat) / 100);
            }
            this.vatAmount = vat;
            finalAmount = amount + this.vatAmount;
            finalAmount = finalAmount + this.shipment;

            // vaT = this.subTotal * (this.vat/100);


            this.grandTotal = finalAmount.toFixed(2);
            // finalAmount = finalAmount - this.paid;
            console.log(finalAmount);
            dueAmount = finalAmount - this.paid;
            this.due = dueAmount.toFixed(2);

            if(this.discountType === 'Percentage'){
                this.discInput = true;
            }else{
                this.discInput = false;
            }



            if(this.paid === 0){
                this.paymentStatus = 'unpaid';
            }
            else{
                this.paymentStatus = 'partial';
            }
            if(this.due === 0){
                this.paymentStatus = 'paid';
            }


            console.log(this.paymentStatus);
            this.calculateTotal();
        },
        getStatus(){
            if(this.userId === 1){
                this.status = 2;
            }

            this.getUser();
        },
        // getPaymentStatus(){
        //     var payment= this.due;
        //     if(payment === !null) {
        //         this.paymentStatus='partial';
        //     }
        // },

        getUnit(keyIndex){
            axios.get('/api/unit-data',{
                params:{
                    id: this.products[keyIndex].productId,
                },
            })
                .then(function(response){
                        this.products[keyIndex].product = response.data;
                        this.products[keyIndex].unit = response.data.uniteShort;
                        console.log(response.data.unitId);
                    }.bind(this)
                );

        },
        // getFormData(id, keyIndex){
        //     axios.get('/api/prefill-data'+id).then(response=>{
        //         this.date = response.data.date
        //         this.branch = response.data.branch
        //         this.purchaseCategory = response.data.purchaseCategory
        //         this.userId = response.data.userId
        //         this.clientId = response.data.clientId
        //         this.supplierId = response.data.supplierId
        //         this.products[keyIndex].productId = response.data.products.productId
        //         this.products[keyIndex].quantity = response.data.products.quantity
        //     })
        // },
        getDiscType: function(e){
            if(e.target.value == 1){
                this.discInput = 1;
            } else{
                this.discInput = 2;
            }
        },

        submit: function (e) {
            axios.post('/api/store-purchase-return', {
                    clientId: this.clientId,
                    purchaseInvoice: this.purchase,
                    supplierId: this.supplierId,
                    projectId:this.projectId,
                    products: this.products,
                    shipment: this.shipment,
                    grandTotal: this.grandTotal,
                    paid: this.paid,
                    due: this.due,
                    date: this.date,
                    paymentStatus: this.paymentStatus,
                    id     : this.idy,

                }).then((response) => {
                    // console.log(response);
                    // this.response = response.data
                    // this.success = 'Data saved successfully';
                    // this.response = JSON.stringify(response, null, 2)
                    this.id = response.data;

                    window.location.href=('/purchase-return-list/');

                    // window.location.href=('/purchase-total/');

                });

            // this.errors = [];
            // if(!this.purchaseCategory){
            //     this.errors.push('purchaseCategory required');
            // }
            // if(!this.userId){
            //     this.errors.push('User Name required');
            // }
            // if(!this.clientId){
            //     this.errors.push('Client Name required');
            // }
            // if(!this.supplierId){
            //     this.errors.push('Supplier Name required');
            // }
            // // if(!this.products.productId){
            // //     this.errors.push('Product Name required');
            // // }
            //
            //
            //
            // e.preventDefault();

        },




    },
    mounted() {

        this.getProduct();
        this.getBranch();
        this.getProject();
        this.getPurchaseReturnId();
        this.getFormData();
        this.getPurchaseType();
        this.getPurchaseId();
        this.getUser();
        this.calculateRowTotal();
        this.calculateTotal();
        this.calculateGrandTotal();
        this.getStatus();
        this.getUnit();
        this.getSupplierAttribute();
        this.getFormData();
        // axios.get("api/table-data").then( response=>{
        //     this.suppliers = response.data.data;
        // })
    }
}
</script>

