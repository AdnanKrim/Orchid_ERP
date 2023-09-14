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
            <label>Date</label>
            <input type="date" class="form-control" name="date" v-model="date" />
        </div>
        <div class="col-md-6">
            <label>LabourId</label>
            <input readonly type="text" class="form-control" name="labourId" v-model="pcgp" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Labour Name<span style='color: #ff0000;'>*</span></label>
            <select id="labourName" class="form-control select2 bg-white" name="labourNameId"   v-model="labourNameId"  >
                <option value="" selected>select labour name</option>
                <option v-for="labourName in labourNames" :key="labourName.id" :value="labourName.id">{{labourName.labourName}}</option>
            </select>
            <li v-if="!this.labourNameId" style="color:red;" v-for="error in errors">{{ error }}</li>
        </div>
        <div class="col-md-6">
            <label>Labour Type<span style='color: #ff0000;'>*</span></label>
            <select id="branch" class="form-control select2 bg-white" name="labourTypeId"   v-model="labourTypeId"  >
                <option value="" selected>select labour type</option>
                <option v-for="labourType in labourTypes" :key="labourType.id" :value="labourType.id">{{labourType.labourTypeName}}</option>
            </select>
            <li v-if="!this.labourTypeId" style="color:red;" v-for="error in errors">{{ error }}</li>
        </div>

    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Under Client<span style='color: #ff0000;'>*</span></label>
            <select id="uuu" class="form-control select2 bg-white" name="clientId"   v-model="clientId" @change="getPurchaseData()"  >
                <option value="" selected>select clients</option>
                <option v-for="client in clients" :key="client.id" :value="client.id">{{client.clientName}}</option>
            </select>
            <li v-if="!this.clientId" style="color:red;" v-for="error in errors">{{ error }}</li>
        </div>
        <div class="col-md-6">
            <label>Purchase Type<span style='color: #ff0000;'>*</span></label>
            <select id="uuu" class="form-control select2 bg-white" name="purchaseCategoryId"  v-model="purchaseCategoryId" @change="getPurchaseData()" >
                <option value="" selected>select purchase Type</option>
                <option v-for="purchase in categories" :key="purchase.id" :value="purchase.id">{{purchase.purchaseType}}</option>
            </select>
            <li v-if="!this.purchaseCategoryId" style="color:red;" v-for="error in errors">{{ error }}</li>
        </div>
    </div>
    <div  class="form-group row" v-for="(key, keyIndex) in products"  :key="key.id">
<!--    <div  class="form-group row" >-->

        <div class="col-md-3" >
<!--            <label v-if="keyIndex == 0">Product<span style='color: #ff0000;'>*</span></label>-->
            <label v-if="keyIndex == 0">Product<span style='color: #ff0000;'>*</span></label>
            <select id="yt" class="form-control select2 bg-white" name="productTypeId[][id]" v-model="key.productId" @change="getUnit(keyIndex)" >
                <option value="" selected>select product</option>
                <option  v-for="good in pcg"  :value="good.id" >{{good.productName}}</option>
            </select>
        </div>

        <div class="col-md-1" >
            <label v-if="keyIndex == 0">Unit</label>
            <input readonly type="text" class="form-control" v-model="key.unit" />
        </div>


        <div class="col-md-2" >
            <label v-if="keyIndex == 0" >Quantity</label>
            <input type="number" class="form-control" name="quantity" v-model="key.quantity" @change="calculateRowTotal(keyIndex)"  />
        </div>


        <div class="col-md-2" >
            <label v-if="keyIndex == 0" >Rate</label>
            <input type="text" class="form-control" name="rate" v-model="key.unitPrice" @change="calculateRowTotal(keyIndex)"  />
        </div>
        <div class="col-md-2" >
            <label v-if="keyIndex == 0" >Price</label>
            <input readonly type="number" min="0" step=".01" class="form-control" name="price" v-model="key.unitTotal" />
        </div>
        <div class="col-md-2">
            <!--                <label  class="row" v-if="keyIndex == 0"></label><br>-->
            <br v-if="keyIndex===0">
            <button  class="btn btn-success btn-sm mt-2 ml-2 " v-if="keyIndex === Object.keys(products).length -1" style="margin-bottom: 0;"  @click="add" title="add" id="add_more_fields">
                <i class="fa fa-plus-circle"></i>
            </button>
            <button  class="btn btn-danger btn-sm mt-2 ml-2" v-if="keyIndex >> 0"  @click="remove"  title="remove">
                <i class="fa fa-minus-circle"></i>
            </button>
        </div>
    </div>
    <div class="form-group row">
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
            <label>CS Amount</label><span style="color:red; font-size: 14px;">  (Company Stay Amount 30%)</span>
            <input readonly type="number" class="form-control" name="CSFCAmount"  v-model="CSFCAmount" @change="calculateGrandTotal()" />

        </div>
        <div class="col-md-6">
            <label>Final Total</label>
            <input readonly type="number" class="form-control" name="finalTotal"  v-model="finalTotal" @change="calculateGrandTotal()" />
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
            id:'',
            goods:[{
                productName:'',
            }],
            labourNames:[{
                labourName:'',
            }],
            labourTypes:[{
                labourTypeName:'',
            }],
            clients:[{
                clientName:'',
            }],
            categories:[{
               purchaseCategory:'',
            }],
            pcg:'',
            pcgp:'',
            purchases:'this purchase',
            purchaseCategoryId:'',
            clientId:'',
            labourNameId:'',
            labourTypeId:'',
            products: [{
                product: [],
                productId:'',
                unit:0,
                quantity:'',
                unitPrice:'',
                unitTotal:0,
            }],
            subTotal:'',
            grandTotal:0,
            due: 0,
            date: '',
            labourId:'',
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
            finalTotal:'',
            CSFCAmount:'',

        }
    },
    methods:{
       getLabourName(){
           axios.get("api/labourname-data").then((response)=>{
               this.labourNames = response.data;
               // console.log(this.labourNames);
           })
        // this.getLabourId();
       },
        getLabourType(){
            axios.get("api/labourtype-data").then((response)=>{
                this.labourTypes = response.data;
                // console.log(this.labourTypes);
            })
        },
        getClient(){
            axios.get("api/client-data").then((response)=>{
                this.clients = response.data;
                // console.log(this.clients);
            })
        this. getPurchaseData();
            // this.getUnit();
        },
        getPurchaseType(){
            axios.get("api/purchase-type-data").then((response)=>{
                this.categories = response.data;
                // console.log(this.clients);
            })
            this.getLabourId();
        },
        getPurchaseData(keyIndex){
            axios.get("api/purchase-data",{
                params:{
                    id:this.clientId,
                },
            })
                .then(function(response){
                        this.pcg = response.data;
                        console.log(this.pcg);
                    }.bind(this)
                )


        },
        getProductData(){
            axios.get("api/product-data").then((response)=>{
                this.goods = response.data;
                // console.log(this.goods);
            })

        },
        getUnit(keyIndex){
            axios.get('api/unit-data',{
                params:{
                    id: this.products[keyIndex].productId ,
                },
            })
                .then(function(response){
                        this.products[keyIndex].product = response.data;
                        this.products[keyIndex].unit = response.data.uniteShort;
                        console.log(response.data.unitId);
                    }.bind(this)
                );

        },
        getLabourId(){
            axios.get("api/labour-id").then((response)=>{
                this.pcgp = response.data;
                // console.log(this.labourNames);
            })
        },


        add: function(e) {
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
            e.preventDefault();
        },
        remove: function(index,key) {
            // this.products--;
            var idx = this.products.indexOf(key);
            console.log(idx, index);
            if (index != 1) {
                this.products.splice(idx, 1);
                localStorage.setItem("products", JSON.stringify(this.products));
            }
            // this.calculateTotal();
        },
        calculateRowTotal(keyIndex){
            var total = parseFloat(this.products[keyIndex].quantity)* parseFloat(this.products[keyIndex].unitPrice);
            if (!isNaN(total)) {
                this.products[keyIndex].unitTotal = total.toFixed(2);
            }
            this.calculateTotal();
        },
        calculateTotal(keyIndex){
            var lineTotal=0;

            // for (let keyIndex = 0; keyIndex < this.products.length; keyIndex++) {
            //
            // }
            lineTotal= this.products.reduce(function (a,b){
                var rowTotal = parseFloat(b.unitTotal);
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
            var csAmount = 0;
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
            csAmount = this.grandTotal * (30/100);
            console.log(csAmount);
            this.CSFCAmount = csAmount.toFixed(2);
            this.finalTotal = this.grandTotal - csAmount
            console.log(this.finalTotal);
            dueAmount = this.finalTotal - this.paid;
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
        submit: function (e){
           if(this.labourNameId && this.labourTypeId && this.clientId && this.purchaseCategoryId){
            axios.post('/api/store-labour', {
                labourNameId: this.labourNameId,
                labourTypeId: this.labourTypeId,
                clientId: this.clientId,
                labourId: this.labourId,
                purchaseCategoryId: this.purchaseCategoryId,
                products: this.products,
                grandTotal: this.grandTotal,
                CSFCAmount: this.CSFCAmount,
                finalTotal: this.finalTotal,
                paid: this.paid,
                due: this.due,
                date: this.date,
                paymentStatus: this.paymentStatus,
                id     : window.location.href.split('/').pop(),
            }).then((response) => {
                // console.log(response);
                // this.response = response.data
                // this.success = 'Data saved successfully';
                // this.response = JSON.stringify(response, null, 2)
                this.id = response.data;

                window.location.href=('/labour-bill-list/');

                // window.location.href=('/purchase-total/');

            })
           }
            this.errors = [];
            if(!this.labourNameId){
                this.errors.push('labourName required!');
            }
            if(!this.labourTypeId){
                this.errors.push('labourType required!');
            }
            if(!this.clientId){
                this.errors.push('Client Name required!');
            }
            if(!this.purchaseCategoryId){
                this.errors.push('purchase Type required!');
            }
            e.preventDefault();
        },

    },


    mounted() {
        this.getLabourName();
        this.getLabourType();
        this.getClient();
        this.getPurchaseType();
        this.getProductData();
        this.calculateRowTotal();
        this.getUnit();
        this.getLabourId();
        // this.calculateRowTotal();


    }
}
</script>
