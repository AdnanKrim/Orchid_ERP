<template>
    <form @submit.prevent="submit()">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Date</label>
                <input type="date" class="form-control" name="date" v-model="date" />
            </div>
            <div class="col-md-6">
                <label>Client Name<span style='color: #ff0000;'>*</span></label>
                <select id="uuu" class="form-control select2 bg-white" name="clientId"   v-model="clientId" @change="getProjectName" >
                    <option value="" selected>client Name</option>
                    <option v-for="client in clients" :key="client.id" :value="client.id" >{{client.clientName}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Project Name<span style='color: #ff0000;'>*</span></label>
                <select id="projectName" class="form-control select2 bg-white" name="projectId"   v-model="projectId" @change="getDuration" >
                    <option value="" selected>select Project</option>
                    <option v-for="project in pcg" :key="project.id" :value="project.id">{{project.projectName}}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Duration</label>
                <input readonly type="text" class="form-control" v-model="duration" />
            </div>
        </div>
        <div v-if="branchId === ''">
            <div class="row form-group">
                <div  class="col-md-6" >
                    <label >Business Branch<span style='color: #ff0000;'>*</span></label>
                    <input readonly type="text" class="form-control" v-model="tt" />
                </div>
            </div>
        </div>
        <div v-else>
            <div class="row form-group">
                <div  class="col-md-6" v-for="branch in branches">
                    <div v-if="branch.id === branchId">
                        <label >Business Branch<span style='color: #ff0000;'>*</span></label>
                        <input readonly type="text" class="form-control" v-model="branch.branchName" />
                    </div>
                </div>
                <div  class="col-md-6" >
                </div>
            </div>
        </div>
        <div class="form-group row" v-for="(key,keyIndex) in products" :key="key.id">
            <div class="col-md-2">
                <label v-if="keyIndex == 0">Product</label>
                <input type="text" class="form-control" name="product" v-model="key.product">
            </div>
            <div class="col-md-2">
                <label v-if="keyIndex == 0">Quantity</label>
                <input type="text" class="form-control" name="product" v-model="key.quantity" @change="calculateRowTotal(keyIndex)">
            </div>
            <div class="col-md-2">
                <label v-if="keyIndex == 0">Unit Price</label>
                <input type="text" class="form-control" name="product" v-model="key.unit" @change="calculateRowTotal(keyIndex)">
            </div>
            <div class="col-md-2">
                <label v-if="keyIndex == 0">Amount</label>
                <input readonly type="text" class="form-control" name="product" v-model="key.amount">
            </div>
            <div class="col-md-2">
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
                <label> Total</label>
                <input readonly type="number" class="form-control" name="total" v-model="total"  />
            </div>

        </div>
        <div class="form-group row text-center mt-4">
            <div class="col-md-10">
                <input type="submit" class="btn btn-success"  value="Submit" />
            </div>
        </div>
    </form>
</template>
<script type="module">
export default {
    data(){
        return{
            clients:[{
                clientName:'',
            }],
            branches:[{
                companyName:'',
            }],
            goods:[{
                projectName:'',
            }],
            clientId:'',
            projectId:'',
            branchId:'',
            date:'',
            owner:'',
            pcg:'',
            duration:'',
            pt:'h',
            total:'',
            project:[
                {
                    projecetName:'',
                }
            ],
            products:[{
                product:'',
                quantity:'',
                unit:'',
                amount:'',
            }]
        }
    },
    computed:{
        getDuration(){
            axios.get('/api/duration-data', {
                params: {
                    id: this.projectId,
                },
            })
                .then(function (response) {
                    //console.log(response.data);
                    this.duration = response.data.duration;
                    this.branchId = response.data.branchId;

                    // this.duration = response.data[0].duration;
                    // this.branchName = response.data[1].branchName;
                }.bind(this));
            this.getBranch();
        },
    },
    methods:{
        getClient(){
            axios.get("/api/client-project").then((response)=>{
                this.clients = response.data;
            });
        },
        getBranch(){
            axios.get("/api/branch-data").then((response)=>{
                //console.log(response.data);
                this.branches = response.data;
            })
        },
        getProjectName(){
            axios.get('/api/project-data',{
                params:{
                    id:this.clientId,
                },
            })
                .then(function (response) {
                        //console.log(response);
                        this.pcg = response.data;
                    }.bind(this)
                );
            //this.getProjectData();
        },
        add:function () {
            this.products.push({
                product: "",
                quantity: "",
                unit:"",
                amount: '',
            });
            localStorage.setItem("productsr",JSON.stringify(this.products));
        },
        remove:function (index,key) {
            var idx = this.products.indexOf(key);
            console.log(idx,index);
            if(index !=1) {
                this.products.splice(idx,1); // at position -1,remove 1 items
                localStorage.setItem("products",JSON.stringify(this.products));
            }
            this.calculateTotal();
        },
        calculateRowTotal(keyIndex){
            var total = parseFloat(this.products[keyIndex].quantity)* parseFloat(this.products[keyIndex].unit);
            if(!isNaN(total)){
                this.products[keyIndex].amount = total.toFixed(2);
            }
            this.calculateTotal();
        },
        calculateTotal(keyIndex){
            var lineTotal = 0;
            lineTotal = this.products.reduce(function (a,b) {
                var rowTotal = parseFloat(b.amount);
                return a + rowTotal;
            },0);
            this.total = lineTotal.toFixed(2);
        },
        submit:function(e){
            axios.post('/api/store-estimate',{
                date : this.date,
                clientId: this.clientId,
                branchId:this.branchId,
                projectId:this.projectId,
                products:this.products,
                total:this.total,
                id: window.location.href.split('/').pop(),
            }).then((response)=>{
                this.id = response.data;
                window.location.href=('/project-estimate-list');
            })
        },
    },
    mounted() {
        this.getClient();
        this.getBranch();
        this.getProjectName();
        this.getName();
    }
}
</script>


































