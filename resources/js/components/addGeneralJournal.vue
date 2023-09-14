<template>
    <div v-if="successful">
      <h1>{{successful}}</h1>
    </div>

    <form @submit.prevent="submit()">
        <div  class="form-group row" v-for="(key, keyIndex) in accountInfo"  :key="key.id">
            <div class="col-md-3" >
                <label v-if="keyIndex == 0">Account</label>
                <select id="yt" class="form-control select2 bg-white" name="account[][id]" v-model="key.accountId">
                    <option value="" selected>Select an Account</option>
                    <option v-for="account in accounts" :value="account.id" >{{account.AccountName}}</option>
                </select>
            </div>
             <div class="col-md-3" >
                <label v-if="keyIndex == 0">Debit Amount</label>
                 <input type="text" class="form-control" name="debitAmount" v-model="key.DebitAmount" />
            </div>
            <div class="col-md-3">
                <label v-if="keyIndex == 0">Credit Amount</label>
                <input type="text" class="form-control" name="CreditAmount" v-model="key.CreditAmount" />
            </div>


            <div class="col-md-3">
                <!--                <label  class="row" v-if="keyIndex == 0"></label><br>-->
                <br v-if="keyIndex===0">
                <button  class="btn btn-success btn-sm mt-2 ml-2 " style="margin-bottom: 0;" v-if="keyIndex == Object.keys(accountInfo).length -1" @click="addAccount" title="addAccount" id="addAccount_more_fields">
                    <i class="fa fa-plus-circle"></i>
                </button>
                <button  class="btn btn-danger btn-sm mt-2 ml-2" v-if="keyIndex >> 0" @click="removeAccount"  title="removeAccount">
                    <i class="fa fa-minus-circle"></i>
                </button>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label>Date</label>
                <input type="date" class="form-control" name="date" v-model="date"/>
            </div>
            <div class="col-md-4">
                <label>Transaction Type</label>
                <input type="text" class="form-control" name="transactionType" v-model="transactionType"/>
            </div>
            <div class="col-md-4">
                <label>Description</label>
                <textarea class="form-control" name="description" v-model="description"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-success"  value="Submit" />
            </div>
        </div>
    </form>

    <pre>{{ response }}</pre>
</template>

<script type="module">
export default {
    props:['userr'],
    data(){
        return{

            accounts:[{
                AccountName: '',
            }],
            accountInfo: [{
                accountId: '',
                DebitAmount: '',
                CreditAmount: '',
            }],
            date:'',
            transactionType:'',
            description:'',
        }
    },
    methods:{
        getAccount(){
            axios.get("api/get-chart-account").then((response)=>{
                this.accounts = response.data;
            });
        },

        addAccount: function() {
            // this.accountInfo++;
            this.accountInfo.push({
                accountId: '',
                DebitAmount: '',
                CreditAmount: '',
            });
            localStorage.setItem("accountInfo", JSON.stringify(this.accountInfo));
        },
        removeAccount: function(index,key) {
            // this.accountInfo--;
            var idx = this.accountInfo.indexOf(key);
            console.log(idx, index);
            if (index != 1) {
                this.accountInfo.splice(idx, 1);
                localStorage.setItem("accountInfo", JSON.stringify(this.accountInfo));
            }
        },

        submit: function (e) {

            let accountId = [];
            let debitAmount = [];
            let creditAmount = [];
            for (let i = 0; i < this.accountInfo.length; i++) {
                accountId.push(this.accountInfo[i].accountId)
                debitAmount.push(this.accountInfo[i].DebitAmount)
                creditAmount.push(this.accountInfo[i].CreditAmount)
            }

                axios.post('/api/add-general-journal', {
                    externalId: null,
                    date: this.date,
                    transactionType: this.transactionType,
                    description: this.description,
                    account: accountId,
                    debit: debitAmount,
                    credit: creditAmount,

                }).then((response) => {
                    console.log(response.data);
                    if (response.data === "Successful") {
                        window.location.href=('/generalJournal-list/');
                    }
                });

            e.preventDefault();
        }
    },
    mounted() {

        this.getAccount();
        this.getUser();
        this.getStatus();
        this.getFormData();
    }
}
</script>
