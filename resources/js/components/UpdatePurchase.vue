<template>
    <p v-if="errors.length">
        <b style="color:red;">Please correct the following error(s):</b>
    <ul>
        <li style="color:red;" v-for="error in errors">{{ error }}</li>
    </ul>
    </p>
    <form @submit.prevent="submit()">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Business Branch</label>
                <select id="branch" class="form-control select2 bg-white" name="branch"   v-model="branch" @change="getPurchase()" >
                    <option :value="branch" selected>{{this.branchName}}</option>
                    <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{branch.companyName}}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Date</label>
                <input type="date" class="form-control" name="date" v-model="date"  />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Purchase Type<span style='color: #ff0000;'>*</span></label>
<!--                <input type="text" class="form-control" id="purchaseCategory" name="purchaseCategory" v-model="purchaseCategory"  />-->
                <select id="purchaseCategory" class="form-control select2 bg-white" name="purchaseCategory"   v-model="purchaseCategory"  >
<!--                    <option value="" selected>select purchase type</option>-->
                    <option v-for="purchaseType in purchaseTypes" :key="purchaseType.id" :value="purchaseType.id" :selected="purchaseCategory === purchaseType.id">{{purchaseType.purchaseType}}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Assign To<span style='color: #ff0000;'>*</span></label>
                <!--                <input type="text" class="form-control" name="userId" v-model="userId" />-->
                <select  class="form-control select2 bg-white" name="userId" id="userId"  v-model="userId" @change="getStatus()"   >
                    <option :value="userId" selected>{{this.userCall}}</option>
<!--                    <option  :value="userr.id">{{userr.name}}</option>-->
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label>Under Client<span style='color: #ff0000;'>*</span></label>
                <select id="uuu" class="form-control select2 bg-white" name="clientId"   v-model="clientId"  >
                    <option :value="clientId" selected>{{this.clientCall}}</option>
                    <option v-for="client in clients" :key="client.id" :value="client.id">{{client.clientName}}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Supplier Name<span style='color: #ff0000;'>*</span></label>
                <select id="oi" class="form-control select2 bg-white" name="supplierId"  v-model="supplierId" @change="getSupplierAttribute()">
<!--                    <option  :value="supplierId" selected>{{this.supplierName}}</option>-->

                    <option v-for="supplier in suppliers"  :key="supplier.id" :value="supplier.id" :selected="supplierId === supplier.id">{{supplier.companyOrStoreName}}</option>
<!--                    <option v-for="supplier in suppliers"  :key="supplier.id" v-if="this.supplierId === supplier.id" selected :value="supplier.id">{{supplier.companyOrStoreName}}</option>-->
                </select>
            </div>
            <div class="col-md-3">
                <label>Owner Name</label>
                <input readonly type="text" class="form-control" v-model="owner" />


            </div>
            <div class="col-md-3">
                <label>Phone Number</label>
                <input readonly type="text" class="form-control" v-model="phone" />
            </div>
        </div>

        <div class="form-group row" v-for="(key, keyIndex) in products"  :key="key.id">

            <div class="col-md-3">
                <label v-if="keyIndex == 0">Product<span style='color: #ff0000;'>*</span></label>
                <select id="yt" class="form-control select2 bg-white" name="productTypeId[][id]" v-model="key.productId" @change="getUnit(keyIndex)"  >
<!--                    <option v-if="products.productId === goods.id"  value="" selected>{{this.goods.productName}}</option>-->

                    <option  v-for="good in goods" :value="good.id" :selected="key.productId === good.id" >{{good.productName}}</option>

                </select>
            </div>
            <div class="col-md-1">
                <label v-if="keyIndex == 0">Unit</label>
                <input readonly type="text" class="form-control" v-model="key.unit" />
            </div>

            <div class="col-md-2">
                <label v-if="keyIndex == 0">Quantity</label>
                <input type="number" class="form-control" name="quantity" v-model="key.quantity"  @change="calculateRowTotal(keyIndex)" />
            </div>

            <div class="col-md-2" >
                <label v-if="keyIndex == 0">Rate</label>
                <input type="text" class="form-control" name="rate" v-model="key.rate"  @change="calculateRowTotal(keyIndex)" />
            </div>
            <div class="col-md-2" >
                <label v-if="keyIndex == 0">Price</label>
                <input readonly type="number" min="0" step=".01" class="form-control" name="price" v-model="key.price" />
            </div>
            <div class="col-md-2">
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
                <input readonly type="number" class="form-control" name="due"  v-model="due" @change="calculateGrandTotal()" />
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
    <p v-if="success"> {{ success }}</p>
    <pre>{{ response }}</pre>
</template>

<script type="module">
export default {
    // props:['userr'],
    // props:['prod'],
    data(){
        return{
            errors:[],
            count:1,
            users:{},
            // productName:'',
            goods:[{
                productName: '',
            }],
            branches:[{
                companyName: '',
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
            supplierId:'',
            supplierName:'',
            clientCall:'',
            branchName:'',
            userCall:'',
            owner:'',
            supowner:'',
            supphone:'',
            phoneNo:'',
            phone:'',
            products: [{
                product: [],
                productId: 'select product',
                unit:0,
                quantity: '',
                rate: '',
                price:0,
            }],
            lineTotal:0,
            allTotal:0,
            subTotal:0,
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
            itemName:[],
            pId:{},

        }
    },
    methods:{

        getSupplier(){
            axios.get("/api/table-data").then((response)=>{
                this.suppliers = response.data;
            });
            this.getPurchase();
        },
        getClient(){
            axios.get("/api/client-data").then((response)=>{
                this.clients = response.data;
                console.log(this.clients);
            });
        },
        getProduct(keyIndex){
            axios.get("/api/product-data").then((response)=>{
                this.goods = response.data;

            });
            // if(this.products[keyIndex].productId === this.goods.id ){
            //
            // }
        },
        getBranch(){
            axios.get("/api/branch-data").then((response)=>{
                this.branches = response.data;
                console.log(response.data);
            });
        },
        getPurchaseType(){
            axios.get("/api/purchaseType-data").then((response)=>{
                this.purchaseTypes = response.data;
                console.log(response.data);
            });
        },
        // getUser(){
        //     this.userId = this.userr.id;
        //     this.userName = this.userr.name;
        //     console.log(this.userId);
        //     // console.log(this.userId);
        //
        // },
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
            var total = parseFloat(this.products[keyIndex].quantity)* parseFloat(this.products[keyIndex].rate);
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

            // vaT = this.subTotal * (this.vat/100);


            this.grandTotal = finalAmount.toFixed(2);
            // finalAmount = finalAmount - this.paid;
            console.log(finalAmount);
            dueAmount = finalAmount - this.paid;
            this.due = dueAmount;

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
        // getStatus(){
        //     if(this.userId === 1){
        //         this.status = 2;
        //     }
        //
        //     this.getUser();
        // },

        // getPaymentStatus(){
        //     var payment= this.due;
        //     if(payment === !null) {
        //         this.paymentStatus='partial';
        //     }
        // },
        getSupplierAttribute(){

            axios.get('/api/supp-data',{
                params:{
                    id:this.supplierId,
                },
            })
                .then(function (response){

                        this.owner = response.data.ownerName;
                        this.phone = response.data.phoneNo;
                    }.bind(this)

                );
        },
        getPurchase(){
           this.idy = window.location.href.split('/').pop();
            console.log(this.idy);
            // console.log(' i am adnan');
         this.getFormData()
            this. getFormSupp()
            this.getFormClient()
            this. getFormBranch()
            this.getFormUser()
            this.getFormProduct()
            // this.getFormProductName();


        },
        getFormData(keyIndex){
            axios.get( '/api/prefill-data',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                this.purchaseCategory = response.data.purchaseCategory;
                this.date = response.data.date;
                this.status = 2;
                // this.items = response.data.products;
                // this.products[keyIndex] = this.items
                // this.products[keyIndex].productId = response.data.products.productId;

                // this.products = response.data.products;

                console.log(this.date);
                // this.supplierId = response.data.companyOrStoreName;
            }.bind(this)
            );

        },
        getFormProduct(keyIndex){
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

            // this.getFormProductName(keyIndex);
        },
        // getFormProductName(keyIndex){
        //     axios.get( '/api/prefill-productName',{
        //         params:{
        //             id:this.idy,
        //         },
        //     }).then(function (response){
        //         this.itemName = response.data
        //
        //         console.log(this.itemName);
        //
        //
        //
        //         }.bind(this)
        //
        //     );
        //
        //
        //
        // },
        getFormSupp(){
            axios.get( '/api/prefill-sup',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.supplierName = response.data.companyOrStoreName;
                    this.supplierId = response.data.id;
                    this.supowner = response.data.ownerName;
                    this.supphone = response.data.phoneNo;

                    // this.supplierId = response.data.companyOrStoreName;
                }.bind(this)
            );
            this.getSupplierAttribute();

        },
        getFormPurchaseType(){
            axios.get( '/api/prefill-purchaseType',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.purchaseCategory = response.data.id;
                }.bind(this)
            );
            this.getSupplierAttribute();

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
        getFormBranch(){
            axios.get( '/api/prefill-branch',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.branchName = response.data.companyName;
                    this.branch = response.data.id;


                    // this.supplierId = response.data.companyOrStoreName;
                }.bind(this)
            );


        },
        getFormUser(){
            axios.get( '/api/prefill-user',{
                params:{
                    id:this.idy,
                },
            }).then(function (response){
                    this.userCall = response.data.name;
                    this.userId = response.data.id;


                    // this.supplierId = response.data.companyOrStoreName;
                }.bind(this)
            );


        },
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
            // if(this.purchaseCategory && this.userId && this.clientId &&  this.supplierId ) {
                axios.post('/api/edit-purchase', {
                    purchaseCategory: this.purchaseCategory,
                    userId: this.userId,
                    clientId: this.clientId,
                    supplierId: this.supplierId,
                    products: this.products,
                    grandTotal: this.grandTotal,
                    paid: this.paid,
                    due: this.due,
                    date: this.date,
                    status: this.status,
                    paymentStatus: this.paymentStatus,
                    branch: this.branch,
                    id     : this.idy,
                }).then((response) => {
                    // console.log(response);
                    // this.response = response.data
                    // this.success = 'Data saved successfully';
                    // this.response = JSON.stringify(response, null, 2)
                    this.id = response.data;

                    window.location.href=('/purchase-list/');

                    // window.location.href=('/purchase-total/');

                });
            }
        //     this.errors = [];
        //     if(!this.purchaseCategory){
        //         this.errors.push('purchaseCategory required');
        //     }
        //     if(!this.userId){
        //         this.errors.push('User Name required');
        //     }
        //     if(!this.clientId){
        //         this.errors.push('Client Name required');
        //     }
        //     if(!this.supplierId){
        //         this.errors.push('Supplier Name required');
        //     }
        //     // if(!this.products.productId){
        //     //     this.errors.push('Product Name required');
        //     // }
        //
        //
        //
        //     e.preventDefault();
        //
        // }




    },
    mounted() {
        this.getSupplier();
        this.getClient();
        this.getProduct();
        this.getBranch();
        this.getPurchaseType();
        // this.getUser();
        this.calculateRowTotal();
        this.calculateTotal();
        this.calculateGrandTotal();
        this.getStatus();
        this.getUnit();
        this.getSupplierAttribute();
        this.getPurchase();
        this.getFormData();
        this.getFormSupp();
        this.getFormClient();
        this. getFormBranch();
        this.getFormUser();
        this.getFormProduct();
        // this.getFormProductName();
    }
}
</script>

