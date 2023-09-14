<template>
    <div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Acc Name<i class="text-danger">*</i></label>
            <div class="col-md-9">
                <input type="text" required class="form-control" v-model="selectedAccName" name="accName"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Opening Balance<i class="text-danger">*</i></label>
            <div class="col-md-9">
                <input type="number" required class="form-control" v-model="selectedBalance" name="openingBalance"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Acc Type<i class="text-danger">*</i></label>
            <div class="col-md-9">
                <select required class="form-control" name="accType" v-model="selectedAccType">
                    <option selected disabled>--select--</option>
                    <option>Cash</option>
                    <option>Bank</option>
                    <option>Mobile Banking</option>
                    <option>Personal</option>
                </select>
            </div>
        </div>
        <div v-if="selectedAccType==='Cash'">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">accNo<i class="text-danger">*</i></label>
                <div class="col-md-9">
                    <input type="number" required class="form-control" v-model="selectedAccNo" name="accNo"/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Note</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="selectedNote" name="note"/>
                </div>
            </div>
        </div>
        <div v-if="selectedAccType==='Personal'">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">accNo<i class="text-danger">*</i></label>
                <div class="col-md-9">
                    <input type="number" required class="form-control" v-model="selectedAccNo" name="accNo"/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Note</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="selectedNote" name="note"/>
                </div>
            </div>
        </div>
        <div v-if="selectedAccType==='Bank'">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Bank</label>
                <div class="col-md-9">
                    <select type="text" v-model="selectedBank" class="form-control" name="bank">
                        <option
                            v-for="bank in banks"
                            :key="bank.id"
                            :value="bank.name"
                            :selected="selectedBank === bank.name"
                        >
                            {{ bank.name}}-{{ bank.accNo}}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div v-if="selectedAccType==='Mobile Banking'">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Mobile Bank<i class="text-danger">*</i></label>
                <div class="col-md-9">
                    <select type="text" required class="form-control" v-model="selectedMobileService" name="mobileService">
                        <option selected disabled>--select--</option>
                        <option :selected="selectedMobileService==='bKash'">bKash</option>
                        <option :selected="selectedMobileService==='Rocket'">Rocket</option>
                        <option :selected="selectedMobileService==='Nogod'">Nogod</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label"></label>
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input"  v-model="selectedNoType" name="numberType" value="Agent" type="radio">
                        <label class="form-check-label">Agent</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" v-model="selectedNoType" name="numberType" value="Personal" type="radio">
                        <label class="form-check-label">Personal</label>
                    </div>
                </div>
            </div>
            <div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">accNo<i class="text-danger">*</i></label>
                    <div class="col-md-9">
                        <input type="number" required class="form-control" v-model="selectedAccNo" name="accNo"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Note</label>
                    <div class="col-md-9">
                        <input type="text" v-model="selectedNote" class="form-control" name="note"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label"></label>
            <div class="col-md-9">
                <input type="submit" class="btn btn-success" value="Save"/>
            </div>
        </div>
    </div>
</template>

<script>
    import {bind} from "lodash";

    export default {
        props: ['acc'],
        data() {
            return {
                selectedAccType: '--select--',
                selectedNoType: '',
                selectedBank: '',
                selectedMobileService: '',
                selectedNote: '',
                selectedAccNo: [],
                selectedBalance: 'select',
                selectedAccName: '',
                banks: '',
                accInfo: '',
            };
        },
        methods: {
            getBank(){
                axios.get("/api/getBanks").then((response) => {
                    this.banks = response.data;
                });
                this.getAcc();
            },
            getAcc(){
                this.selectedBank = this.acc.bank;
                this.selectedAccType = this.acc.accType;
                this.selectedBalance = this.acc.openingBalance;
                this.selectedAccName = this.acc.accName;
                this.selectedMobileService = this.acc.mobileService;
                this.selectedAccNo = this.acc.accNo;
                this.selectedNote = this.acc.note;
                this.selectedNoType = this.acc.numberType;
            }
        },
        mounted() {
            this.getBank();
        }
    }
</script>

<style scoped>

</style>
