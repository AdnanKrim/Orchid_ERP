<template>
    <form @submit.prevent="submit()">
        <div>
            <div v-for="(tab, tabIndex) in tabs" :key="tab.id">
                <div class="col-md-4 offset-md-4 d-flex">
                    <label>Measurement Types</label>
                </div>
                <div class="col-md-4 offset-md-4 d-flex">
                    <select
                        v-model="tab.selectedMeasureType"
                        @change="getMeasureStruct(tabIndex)"
                        class="form-control select2"
                    >
                        <option >select</option>
                        <option
                            v-for="measureType in measureTypes"
                            :key="measureType.id"
                            :value="measureType.id"
                        >
                            {{ measureType.measurementTypeName }}
                        </option>
                    </select>
                    <div class="col-md-3">
                        <select
                            v-model="tab.ft"
                            class="form-control select2"
                        >
                            <option>cubeFt</option>
                            <option>Ft</option>
                            <option>Inches</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button v-if="tabIndex == Object.keys(tabs).length -1" class="btn btn-success btn-sm mt-2 ml-1" @click="addTab">
                            <i class="fa fa-plus"></i>
                        </button>
                        <button class="btn btn-danger btn-sm mt-2 ml-1" @click="removeTab(tabIndex, tab)">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-borderless col-md-12">
                        <thead>
                        <th class="col-md-1"></th>
                        <th class="col-md-2">MeasurementStructure</th>
                        <th class="col-md-2">StructureNo</th>
                        <th class="col-md-2">Length({{tab.ft}})</th>
                        <th class="col-md-1">Width({{tab.ft}})</th>
                        <th class="col-md-1">Height({{tab.ft}})</th>
                        <th class="col-md-2">Qty</th>
                        <th class="col-md-1"></th>
                        </thead>
                        <tbody v-for="(row, rowIndex) in tab.rows" :key="row.id">
                        <td class="">
                            <select
                                v-model="row.operator"
                                @change="calculateQty(tabIndex,rowIndex)"
                                @input="calculateLineTotal(tabIndex,rowIndex)"
                                @click="calculateTotal1(tabIndex)"
                                class="form-control select2"
                            >
                                <option selected value="2">+</option>
                                <option value="1">-</option>
                            </select>
                        </td>
                        <td class="col-md-2">
                            <select
                                v-model="row.selectedStructure"
                                @change="getRate(tabIndex, rowIndex)"
                                class="form-control select2"
                            >
                                <option selected="disabled">select</option>
                                <option
                                    v-for="measureStruct in tab.measureStructs"
                                    :key="measureStruct.id"
                                    :value="measureStruct.id"
                                >
                                    {{ measureStruct.measurementStructureName }}
                                </option>
                            </select>
                        </td>
                        <td class="col-md-1">
                            <input
                                class="form-control text-right"
                                type="number"
                                min=""
                                step="any"
                                v-model="row.selectedStructNo"
                                @change="calculateQty(tabIndex,rowIndex)"
                                @input="calculateLineTotal(tabIndex,rowIndex)"
                                @click="calculateLineTotal(tabIndex,rowIndex)"
                            />
                        </td>
<!--                        <td class="col-md-1">-->

<!--                        </td>-->
                        <td>
                            <input
                                class="form-control text-right"
                                type="number"
                                min="0"
                                step="any"
                                v-model="row.selectedLength"
                                @change="calculateQty(tabIndex,rowIndex)"
                                @input="calculateLineTotal(tabIndex,rowIndex)"
                                @click="calculateLineTotal(tabIndex,rowIndex)"
                            />
                        </td>
                        <td>
                            <input
                                class="form-control text-right"
                                type="number"
                                min="0"
                                step="any"
                                v-model="row.selectedWidth"
                                @change="calculateQty(tabIndex,rowIndex)"
                                @input="calculateLineTotal(tabIndex,rowIndex)"
                                @click="calculateLineTotal(tabIndex,rowIndex)"
                            />
                        </td>
                        <td>
                            <input
                                class="form-control text-right"
                                type="number"
                                min="0"
                                step="any"
                                v-model="row.selectedHeight"
                                @change="calculateQty(tabIndex,rowIndex)"
                                @input="calculateLineTotal(tabIndex,rowIndex)"
                                @click="calculateTotal1(tabIndex)"
                            />
                        </td>
                        <td>
                            <input
                                class="form-control text-right"
                                type="number"
                                min=""
                                step="any"
                                v-model="row.selectedQty"
                                @change="calculateQty(tabIndex,rowIndex)"
                                @input="calculateLineTotal(tabIndex,rowIndex)"
                                @click="calculateLineTotal(tabIndex,rowIndex)"
                            />
                        </td>
<!--                        <td>-->

<!--                        </td>-->
                        <td>
                            <button  v-if="rowIndex == Object.keys(tab.rows).length -1" type="button" class="btn btn-success btn-sm mt-2 mr-1" @click="addRow(tabIndex)">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button  type="button"
                                     class="btn btn-danger btn-sm mt-2"
                                     @click="removeRow(rowIndex, row,tabIndex)">
                                <i class="fa fa-minus"></i>
                            </button>
                        </td>
                        </tbody>
                    </table>
                    <hr />
                </div>
            </div>
            <div v-for="(tab, tabIndex) in tabs" :key="tab.id">
                    <table class="table table-borderless col-md-8">
                        <thead>
                        <th class="col-md-2">Measurement Type</th>
                        <th class="">Rate</th>
                        <th class="col-md-1">Qty</th>
                        <th class="col-md-1">Total</th>
                        <th class="col-md-1"></th>
                        </thead>
                        <tbody>
                        <td>
                            <input
                                readonly
                                v-model="tab.MeasureTypeName"
                                @change="getRate1(tabIndex)"
                                class="form-control select2"
                            >
                        </td>
                        <td class="col-md-1">
                            <input
                                readonly
                                class="form-control text-right"
                                type="number"
                                v-model="tab.tabRate"
                                @change="calculateLineTotal1(tabIndex)"
                            />
                        </td>
                        <td>
                            <input
                                readonly
                                class="form-control text-right"
                                type="number"
                                min="0"
                                v-model="tab.tabQty"
                                @change="calculateLineTotal1(tabIndex)"
                            />
                        </td>
                        <td>
                            <input
                                readonly
                                class="form-control text-right"
                                type="number"
                                min="0"
                                v-model="tab.tabtotal"
                                @click="calculateLineTotal1(tabIndex)"
                            />
                        </td>
                        <td>

                        </td>
                        </tbody>
                    </table>
            </div>
            <div v-for="(tab, tabIndex) in tabs1" :key="tab.id">
                <table class="table table-borderless col-md-8">
                    <thead>
                    <th class="col-md-2">Measurement Type</th>
                    <th class="">Rate</th>
                    <th class="col-md-1">Qty</th>
                    <th class="col-md-1">Total</th>
                    <th class="col-md-1"></th>
                    </thead>
                    <tbody>
                    <td>
                        <select
                            v-model="tab.selectedMeasureType"
                            @change="getRate1(tabIndex)"
                            class="form-control select2"
                        >
                            <option selected :value="0">select</option>
                            <option
                                v-for="measureType in measureTypes"
                                :key="measureType.id"
                                :value="measureType.id"
                            >
                                {{ measureType.measurementTypeName }}
                            </option>
                        </select>
                    </td>
                    <td class="col-md-1">
                        <input
                            class="form-control text-right"
                            type="number"
                            min="0"
                            step="any"
                            v-model="tab.selectedRate"
                            @change="calculateLineTotal1(tabIndex)"
                        />
                    </td>
                    <td>
                        <input
                            class="form-control text-right"
                            type="number"
                            min="0"
                            v-model="tab.selectedQty"
                            @change="calculateLineTotal1(tabIndex)"
                        />
                    </td>
                    <td>
                        <input
                            readonly
                            class="form-control text-right"
                            type="number"
                            min="0"
                            v-model="tab.line_total"
                            @click="calculateLineTotal1(tabIndex)"
                        />
                    </td>
                    <td>
                        <button v-if="tabIndex == Object.keys(tabs1).length -1" class="btn btn-success btn-sm mt-2 ml-2" @click="addTab1">
                            <i class="fa fa-plus"></i>
                        </button>
                        <button v-if="tabIndex != 0" class="btn btn-danger btn-sm mt-2 ml-2" @click="removeTab1(tabIndex, tab)">
                            <i class="fa fa-minus"></i>
                        </button>
                    </td>
                    </tbody>
                </table>
            </div>



            <div class="col-md-6 float-right px-0">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">All TotalAmount</label>
                    <div class="col-md-9">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            step="any"
                            required
                            name="subtotal"
                            v-model="allTotal"
                            @click="calculateTotal1(tabIndex)"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Total Quantity</label>
                    <div class="col-md-9">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            v-model="totalQty"
                            @click="calculateTotal1(tabIndex)"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">disc%</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            class="form-control"
                            step="any"
                            required
                            name="vat"
                            v-model="disc"
                            @change="calculateTotal1(tabIndex)"
                        />
                    </div>
                    <label class="col-md-2 col-form-label"><div class="float-right">Amount</div></label>
                    <div class="col-md-4">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            step="any"
                            name="vatC"
                            v-model="discC"
                            @change="calculateTotal1(tabIndex)"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Vat%</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            class="form-control"
                            step="any"
                            required
                            name="vat"
                            v-model="vat"
                            @change="calculateTotal1(tabIndex)"
                        />
                    </div>
                    <label class="col-md-2 col-form-label"><div class="float-right">Amount</div></label>
                    <div class="col-md-4">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            step="any"
                            name="vatC"
                            v-model="vatC"
                            @change="calculateTotal1(tabIndex)"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Grand Total</label>
                    <div class="col-md-9">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            step="any"
                            required
                            name="total"
                            v-model="finalTotal"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Advanced</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            class="form-control"
                            step="any"
                            required
                            name="vat"
                            v-model="adv"
                            @change="calculateTotal1(tabIndex)"
                        />
                    </div>
                    <label class="col-md-2 col-form-label text-danger"><div class="float-right">Payable</div></label>
                    <div class="col-md-4">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            step="any"
                            name="vatC"
                            v-model="payable"
                            @change="calculateTotal1(tabIndex)"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 float-right">
            <input type="submit" class="btn btn-success">
        </div>
    </form>
</template>

<script type="module">
    export default {
        data() {
            return {
                tabs: [{
                    selectedMeasureType: "",
                    ft: "",
                    measureStructs: {},
                    MeasureType: {},
                    MeasureTypeName: {},
                    tabQty: 0,
                    tabRate: 0,
                    tabtotal: 0,
                    rows: [{
                        selectedStructure: "",
                        selectedStructNo: "",
                        selectedRate: "",
                        selectedLength: 1,
                        selectedWidth: 1,
                        selectedHeight: 1,
                        selectedQty: "",
                        line_total: 0,
                        operator: 2,
                    }],
                }],
                tabs1: [{
                    tabQty: 0,
                    selectedMeasureType: "",
                    selectedRate: 0,
                    selectedQty: 0,
                    line_total: 0,
                }],
                subtotal: 0,
                allTotal: 0,
                halfTotal: 0,
                allTotal1: 0,
                allQty: 0,
                halfQty: 0,
                totalQty: 0,
                finalTotal: 0,
                total: 0,
                vatC: 0,
                rate: 0,
                vat: 0,
                discC: 0,
                disc: 0,
                adv: 0,
                payable: 0,
                tabCounter: 0,
                measureTypes: {},
                id: {},
                mId: {},
            };
        },

        methods: {
            addRow(tabIndex) {
                this.tabs[tabIndex].rows.push({
                    selectedStructure: "",
                    selectedStructNo: "",
                    selectedRate: "",
                    selectedLength: 1,
                    selectedWidth: 1,
                    selectedHeight: 1,
                    selectedQty: 0,
                    line_total: 0,
                    operator: 2,
                });
                localStorage.setItem("rows", JSON.stringify(this.rows));
            },
            addTab() {
                this.tabs.push({
                    selectedMeasureType: "",
                    ft: "",
                    measureStructs: {},
                    MeasureType: {},
                    MeasureTypeName: {},
                    tabQty: 0,
                    tabRate: 0,
                    tabtotal: 0,
                    rows: [{
                        selectedStructure: "",
                        selectedStructNo: "",
                        selectedRate: "",
                        selectedLength: 1,
                        selectedWidth: 1,
                        selectedHeight: 1,
                        selectedQty: "",
                        line_total: 0,
                        operator: 2,
                    },
                    ],
                });
                localStorage.setItem("tabs", JSON.stringify(this.tabs));
            },
            addTab1() {
                this.tabs1.push({
                    tabQty: 0,
                    selectedMeasureType: "",
                    selectedRate: 0,
                    selectedQty: 0,
                    line_total: 0,
                });
                localStorage.setItem("tabs1", JSON.stringify(this.tabs1));
            },
            getMeasureTypes() {
                axios.get("/api/measureTypes").then((response) => {
                    this.measureTypes = response.data;
                    // console.log(response.data);
                });
            },
            getMeasureStruct(tabIndex) {
                axios
                    .get("/api/measure-struct", {
                        params: {
                            measureTypeId: this.tabs[tabIndex].selectedMeasureType,
                        },
                    })
                    .then(
                        function (response) {
                            console.log(response.data);
                            this.tabs[tabIndex].measureStructs = response.data;
                        }.bind(this)
                    );
            },
            getRate(tabIndex,rowIndex) {
                axios
                    .get("/api/rate", {
                        params: {
                            id: this.tabs[tabIndex].selectedMeasureType,
                        },
                    })
                    .then(
                        function (response) {
                            this.tabs[tabIndex].MeasureType = response.data;
                            this.tabs[tabIndex].MeasureTypeName = response.data.measurementTypeName;
                            this.tabs[tabIndex].rows[rowIndex].selectedRate =
                                response.data.rate;
                            this.tabs[tabIndex].tabRate =
                                response.data.rate;
                            console.log(response.data.rate);
                        }.bind(this)
                    );
                this.calculateQty(tabIndex, rowIndex);
                this.calculateTotal(tabIndex, rowIndex);
                this.calculateTotal1(tabIndex);
                this.calculateLineTotal(tabIndex, rowIndex);
                this.calculateLineTotal1(tabIndex);
            },
            getRate1(tabIndex) {
                if (this.tabs1[tabIndex].selectedMeasureType === 0){
                    this.tabs1[tabIndex].selectedRate = 0;
                }else{
                    axios
                        .get("/api/rate", {
                            params: {
                                id: this.tabs1[tabIndex].selectedMeasureType,
                            },
                        })
                        .then(
                            function (response) {
                                console.log(response.data);
                                this.tabs1[tabIndex].MeasureType = response.data;

                                this.tabs1[tabIndex].selectedRate =
                                    response.data.rate;
                                console.log(response.data.rate);
                            }.bind(this)
                        );
                    this.calculateQty(tabIndex, rowIndex);
                    this.calculateTotal(tabIndex, rowIndex);
                    this.calculateTotal1(tabIndex);
                    this.calculateLineTotal(tabIndex, rowIndex);
                    this.calculateLineTotal1(tabIndex);
                }
            },
            submit() {
                axios.post('/api/create-measure-cart', {
                    mt        : this.tabs,
                    mt1       : this.tabs1,
                    finalTotal: this.finalTotal,
                    allTotal  : this.allTotal,
                    totalQty  : this.totalQty,
                    vatC      : this.vatC,
                    discC     : this.discC,
                    adv       : this.adv,
                    payable   : this.payable,
                    id     : window.location.href.split('/').pop(),
                }).then((response) => {
                    this.id = response.data.id;
                    this.mId = response.data.mId;
                    window.location.href=('/view-measure-cart/'+this.id+'/'+this.mId);
                })
            },
            calculateQty(tabIndex,rowIndex) {
                var operator=parseFloat(this.tabs[tabIndex].rows[rowIndex].operator)
                var structNos0 = this.tabs[tabIndex].rows[rowIndex].selectedStructNo;
                if (operator === 1) {
                    if (structNos0 > 0){
                        var structNos1 = structNos0 * (-1);
                        this.tabs[tabIndex].rows[rowIndex].selectedStructNo = structNos0 * (-1);
                    }else if(structNos0 < 0){
                        structNos1 = structNos0 * (1);
                        this.tabs[tabIndex].rows[rowIndex].selectedStructNo = structNos0 * (1);
                    }

                    if (this.tabs[tabIndex].ft === 'Ft'){
                        var total =
                            structNos1 *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedLength) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedWidth) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedHeight) ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'cubeFt'){
                           total =
                            (structNos1 *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedLength) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedHeight)/1728) ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'Inches'){
                          total =
                            (structNos1 *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedLength) *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedHeight)/144) ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }
                }else if(operator ===2){
                    if (structNos0 > 0){
                        var structNos2 = structNos0 * (1);
                        this.tabs[tabIndex].rows[rowIndex].selectedStructNo = structNos0 * (1);
                    }else if(structNos0 < 0){
                        structNos2 = structNos0 * (-1);
                        this.tabs[tabIndex].rows[rowIndex].selectedStructNo = structNos0 * (-1);
                    }
                    if (this.tabs[tabIndex].ft === 'Ft'){
                          total =
                            structNos2 *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedLength) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedWidth) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedHeight) ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'cubeFt'){
                        total =
                            (structNos2 *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedLength) *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedHeight)/1728) ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'Inches'){
                        total =
                            (structNos2 *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedLength) *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedHeight)/144) ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }
                }
                this.calculateTotal(tabIndex, rowIndex);
                this.calculateTotal1(tabIndex);
                this.calculateLineTotal(tabIndex,rowIndex);
                this.calculateLineTotal1(tabIndex);
            },
            calculateLineTotal(tabIndex,rowIndex) {
                var total =
                    parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedRate) *
                    parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedQty);
                if (!isNaN(total)) {
                    this.tabs[tabIndex].rows[rowIndex].line_total = total.toFixed(2);
                }
                this.calculateTotal(tabIndex, rowIndex);
            },
            calculateLineTotal1(tabIndex) {
                var total1 =
                    parseFloat(this.tabs1[tabIndex].selectedRate) *
                    parseFloat(this.tabs1[tabIndex].selectedQty);
                if (!isNaN(total1)) {
                    this.tabs1[tabIndex].line_total = total1.toFixed(2);
                }
                this.calculateTotal1(tabIndex);
            },
            calculateTotal(tabIndex,rowIndex) {
                var subtotal=0;
                var tabtotal=0;
                var tabMeasureType='';
                var halfTotal=0;
                var allTotal=0;
                var allQty=0;
                var tabQty=0;
                var halfQty=0;
                var finalTotal=0;
                var payable=0;
                var total, discC, adv, vatC;

                for (let tabIndex = 0; tabIndex < this.tabs.length; tabIndex++) {
                    allQty = this.tabs[tabIndex].rows.reduce(function (sum, product) {
                        var selectedQty = parseFloat(product.selectedQty);
                        if (!isNaN(selectedQty)) {
                            return sum + selectedQty;
                        }
                    }, 0);
                    tabQty = allQty;
                    halfQty += allQty;
                    this.halfQty = halfQty.toFixed(2);
                    console.log(this.halfQty,this.halfQty,this.halfQty,this.halfQty);
                    this.tabs[tabIndex].tabQty = tabQty.toFixed(2);

                }

                for (let tabIndex = 0; tabIndex < this.tabs.length; tabIndex++) {
                    subtotal = this.tabs[tabIndex].rows.reduce(function (sum, product) {
                        var lineTotal = parseFloat(product.line_total);
                        if (!isNaN(lineTotal)) {
                            return sum + lineTotal;
                        }
                    }, 0);
                    tabtotal = subtotal;
                    halfTotal += subtotal;

                    this.tabs[tabIndex].tabtotal = tabtotal.toFixed(2);
                    this.halfTotal = halfTotal.toFixed(2);
                    //or if you pass float numbers , use parseFloat()
                }
            },
            calculateTotal1(tabIndex) {
                var subtotal=0;
                var tabtotal=0;
                var allTotal=0;
                var halfTotal=0;
                var allQty=0;
                var halfQty=0;
                var tabQty=0;
                var totalQty=0;
                var finalTotal=0;
                var payable=0;
                var total, discC, adv, vatC;

                for (let tabIndex = 0; tabIndex < this.tabs1.length; tabIndex++) {
                    allQty = this.tabs1.reduce(function (sum, product) {
                        var selectedQty = parseFloat(product.selectedQty);
                        if (!isNaN(selectedQty)) {
                            return sum + selectedQty;
                        }
                    }, 0);
                    tabQty = allQty;
                    this.tabs1[tabIndex].tabQty = tabQty.toFixed(2);
                }
                halfQty = parseFloat(this.halfQty);
                totalQty = (halfQty + allQty);
                this.totalQty = totalQty.toFixed(2);

                for (let tabIndex = 0; tabIndex < this.tabs1.length; tabIndex++) {
                    subtotal = this.tabs1.reduce(function (sum, product) {
                        var lineTotal = parseFloat(product.line_total);
                        if (!isNaN(lineTotal)) {
                            return sum + lineTotal;
                        }
                    }, 0);
                    tabtotal = subtotal;
                    this.allTotal1 = subtotal.toFixed(2);
                    console.log(this.allTotal1);
                }
                halfTotal = parseFloat(this.halfTotal);
                allTotal = (halfTotal + subtotal);
                console.log(allTotal);
                this.allTotal = allTotal.toFixed(2);
                total = allTotal - allTotal * (this.disc / 100);
                total = parseFloat(total);
                if (!isNaN(total)) {
                    this.total = total.toFixed(2);
                } else {
                    this.total = "0.00";
                }
                console.log(total);
                discC  = allTotal * (this.disc / 100);
                discC = parseFloat(discC);
                if (!isNaN(discC)) {
                    this.discC = discC.toFixed(2);
                } else {
                    this.discC = "0.00";
                }
                //vat......
                finalTotal = total * (this.vat / 100) + total;
                finalTotal = parseFloat(finalTotal);
                if (!isNaN(finalTotal)) {
                    this.finalTotal = finalTotal.toFixed(2);
                } else {
                    this.finalTotal = "0.00";
                }
                vatC  = total * (this.vat / 100);
                vatC = parseFloat(vatC);
                if (!isNaN(vatC)) {
                    this.vatC = vatC.toFixed(2);
                } else {
                    this.vatC = "0.00";
                }
                payable = finalTotal - this.adv;
                payable = parseFloat(payable);
                if (!isNaN(payable)) {
                    this.payable = payable.toFixed(2);
                } else {
                    this.payable = "0.00";
                }
            },
            removeRow(rowIndex, row,tabIndex) {
                var idx = this.tabs[tabIndex].rows.indexOf(row);
                console.log(idx, rowIndex);
                if (rowIndex != 0) {
                    this.tabs[tabIndex].rows.splice(idx, 1);
                    localStorage.setItem("rows", JSON.stringify(this.rows));
                }
            },
            removeTab(index, tab) {
                var idx = this.tabs.indexOf(tab);
                console.log(idx, index);
                if (index != 0) {
                    this.tabs.splice(idx, 1);
                    localStorage.setItem("tabs", JSON.stringify(this.tabs));
                }
                this.calculateTotal();
            },
            removeTab1(index, tab) {
                var idx = this.tabs1.indexOf(tab);
                console.log(idx, index);
                if (index != 0) {
                    this.tabs1.splice(idx, 1);
                    localStorage.setItem("tabs1", JSON.stringify(this.tabs1));
                }
                this.calculateTotal();
            },
            getTabs() {
                if (window.location.href.split('/').pop()){
                    this.tabs = JSON.parse(localStorage.getItem("tabs"));
                }
            },
            getTabs1() {
                if (window.location.href.split('/').pop()){
                    this.tabs1 = JSON.parse(localStorage.getItem("tabs1"));
                }
            },
        },
        watch: {
            tabs: {
                handler() {
                    localStorage.setItem("tabs", JSON.stringify(this.tabs));
                },
                deep: true,
            },
            tabs1: {
                handler() {
                    localStorage.setItem("tabs1", JSON.stringify(this.tabs1));
                },
                deep: true,
            },
        },
        mounted() {
            this.getMeasureTypes();
            if (localStorage.getItem("tabs")) {
                this.getTabs();
            }
            if (localStorage.getItem("tabs1")) {
                this.getTabs1();
            }
            this.calculateTotal();
            this.calculateTotal1();

        },
    };
</script>

<style scoped>
</style>
