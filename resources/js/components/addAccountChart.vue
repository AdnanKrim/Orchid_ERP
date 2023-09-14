<template>
    <form @submit.prevent="submit()">

        <div class="form-group row">
            <div class="col-md-3">
                <label for="accType">Account Type</label>
                <select
                    class="form-control"
                    name="accType"
                    id="accType"
                    v-model="typeId"
                    @change="getAccountGroup()"
                >
                    <option selected value="" disabled>Select an Account Type</option>
                    <option v-for="accountType in accountTypes" :value="accountType.id" :key="accountType.id">
                        {{ accountType.AccountType }}
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="accGroup">Account Group</label>

                    <select class="form-control" name="accGroup" id="accGroup" v-model="groupId">
                        <option selected value="" disabled>Select an Account type</option>
                        <option v-for="accountGroup in accountGroups" :value="accountGroup.id" :key="accountGroup.id">{{accountGroup.AccountGroup}}</option>
                    </select>

            </div>
            <div class="col-md-3">
                <label for="name">Account Name</label>
                <input class="form-control" type="text" name="name" id="name" v-model="accountName">
            </div>
            <div class="col-md-3">
                <label for="side">Side</label>
                <div class="input-group search_select_box">
                    <select class="form-control" name="side" id="side" v-model="side">
                        <option selected value="" disabled>Choose a side</option>
                        <option value="Debit">Debit</option>
                        <option value="Credit">Credit</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="code">Account Code</label>
                <input class="form-control" type="text" name="code" id="code" v-model="accountCode">
            </div>
            <div class="col-md-4">
                <label for="balance">Balance</label>
                <input class="form-control" type="number" name="balance" id="balance" v-model="balance">
            </div>
            <div class="col-md-4">
                <label for="date">As of date</label>
                <input class="form-control" type="date" name="date" id="date" v-model="date">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-success" value="Add"/>
            </div>
        </div>
    </form>

</template>

<script>
export default {
    name: "addAccountChart",
    data(){
        return{
            accountTypes:[],
            accountGroups:[],
            accountName:'',
            side:'',
            accountCode:'',
            balance:'0',
            date:'',
            typeId:'',
            groupId:'',
        }
    },
    methods:{
        getAccountType(){
            axios.get("api/get-account-type").then((response)=>{
                console.log(response.data)
                this.accountTypes = response.data;
                this.groupId = '';
            });
        },
        getAccountGroup(){
            this.groupId = '';
            axios.get("api/get-account-group",{
                params: {
                    type: this.typeId,
                },
            })
                .then((response)=>{
                console.log(response.data)
                this.accountGroups = response.data;
            });
        },
        submit: function (e) {
            axios.post('/api/account-chart-post', {
                accType: this.typeId,
                accGroup: this.groupId,
                name: this.accountName,
                code: this.accountCode,
                balance: this.balance,
                side: this.side,
                date: this.date,

            }).then((response) => {
                console.log(response.data);
                if (response.data === "Successful") {
                    window.location.href=('/account-chart-list/');
                }
            });
        }
    },
    mounted() {
        this.getAccountType();
    }
}
</script>


