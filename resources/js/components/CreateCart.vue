<template>
    <form @submit.prevent="submit()">
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Subject</label>
                <div class="col-md-5">
                    <input
                        type="text"
                        class="form-control"
                        v-model="subject"
                        required
                        name="subject"
                    />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Body</label>
                <div class="col-md-10">
            <textarea
                class="form-control"
                v-model="body"
                required
                name="body"
            ></textarea>
                </div>
            </div>
            <hr />
            <div v-for="(tab, tabIndex) in tabs" :key="tab.id">
                <div class="col-md-4 offset-md-4 d-flex">
                    <label>HouseAreaTypes</label>
                </div>
                <div class="col-md-6 offset-md-4 d-flex">
                    <select
                        v-model="tab.selectedHouseType"
                        @change="getDecor(tabIndex)"
                        class="form-control select2"
                        id="houseType1"
                        required
                        name="houseAreaTypeId[][id]"
                    >
                        <option>select</option>
                        <option
                            v-for="houseType in houseTypes"
                            :key="houseType.id"
                            :value="houseType.id"
                        >
                            {{ houseType.name }}
                        </option>
                    </select>
                    <div class="col-md-2">
                        <select
                            class="form-control"
                            v-model="tab.ft"
                            @change="calculateQty(tabIndex,rowIndex)"
                        >
                            <option>select</option>
                           <option>cubeFt</option>
                           <option selected>Ft</option>
                           <option>Inches</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button v-if="tabIndex == Object.keys(tabs).length -1" class="btn btn-success btn-sm mt-2 ml-2" @click="addTab">
                            <i class="fa fa-plus"></i>
                        </button>
                        <button class="btn btn-danger btn-sm mt-2 ml-2" @click="removeTab(tabIndex, tab)">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-borderless col-md-12">
                        <thead>
                        <th class="col-md-1"></th>
                        <th class="col-md-1">DecorationType</th>
                        <th class="col-md-1">Description</th>
                        <th class="">Unit</th>
                        <th class="col-md-1">StructNos</th>
                        <th class="col-md-1">Length({{tab.ft}})</th>
                        <th class="col-md-1">Width({{tab.ft}})</th>
                        <th class="col-md-1">Height({{tab.ft}})</th>
                        <th class="col-md-1">Rate</th>
                        <th class="col-md-1">Quantity</th>
                        <th class="col-md-1">TotalAmount</th>
                        <th class="col-md-1"></th>
                        </thead>
                        <tbody v-for="(row, rowIndex) in tab.rows" :key="row.id">
                        <td class="px-0">
                            <select
                            v-model="row.operator"
                            class="form-control select2"
                            @change="calculateQty(tabIndex,rowIndex)"
                            >
                                <option value="1">Automatic</option>
                                <option value="2">Manual</option>
                            </select>
                        </td>
                        <td class="px-1">
                            <select
                                v-model="row.selectedDecor"
                                @change="getDescription(tabIndex,rowIndex)"
                                class="form-control select2"
                                required
                                name="houseAreaTypeId[][houseAreaCartInfo[decId]]"
                            >
                                <option>select</option>
                                <option
                                    v-for="decorType in tab.decorTypes"
                                    :key="decorType.id"
                                    :value="decorType.id"
                                >
                                    {{ decorType.name }}
                                </option>
                            </select>
                        </td>
                        <td class="px-0">
                            <input
                                class="form-control text-right"
                                type="text"
                                name="houseAreaTypeId[][houseAreaCartInfo[des]]"
                                v-model="row.selectedDes"
                            />
                        </td>
                        <td class="px-1">
                            <input
                                class="form-control text-right"
                                type="text"
                                name="houseAreaTypeId[][houseAreaCartInfo[rate]]"
                                v-model="row.selectedUnit"
                            />
                        </td>
                        <td class="px-0">
                            <div v-if="row.operator === 1">
                                <input
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.structNos"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                            <div v-else>
                                <input
                                    readonly
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.structNos"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                        </td>
                        <td class="px-1">
                            <div v-if="row.operator === 1">
                                <input
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.length"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                            <div v-else>
                                <input
                                    readonly
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.length"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                        </td>
                        <td class="px-0">
                            <div v-if="row.operator === 1">
                                <input
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.width"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                            <div v-else>
                                <input
                                    readonly
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.width"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                        </td>
                        <td class="px-1">
                            <div v-if="row.operator === 1">
                                <input
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.height"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                            <div v-else>
                                <input
                                    readonly
                                    class="form-control text-right"
                                    type="number"
                                    v-model="row.height"
                                    @change="calculateQty(tabIndex,rowIndex)"
                                >
                            </div>
                        </td>
                        <td class="px-0">
                            <input
                                class="form-control text-right"
                                type="number"
                                min="0"
                                name="houseAreaTypeId[][houseAreaCartInfo[rate]]"
                                v-model="row.selectedRate"
                                @change="calculateLineTotal(tabIndex,rowIndex)"
                            />
                        </td>
                        <td class="px-1">
                            <div v-if="row.operator === 1">
                                <input
                                    readonly
                                    class="form-control text-right"
                                    type="number"
                                    min="0"
                                    v-model="row.selectedQty"
                                    @change="calculateLineTotal(tabIndex,rowIndex)"
                                />
                            </div>
                            <div v-else>
                                <input
                                    class="form-control text-right"
                                    type="number"
                                    min="0"
                                    v-model="row.selectedQty"
                                    @change="calculateLineTotal(tabIndex,rowIndex)"
                                />
                            </div>

                        </td>
                        <td class="px-0">
                            <input
                                readonly
                                class="form-control text-right"
                                type="number"
                                min="0"
                                step=".01"
                                name="houseAreaTypeId[][houseAreaCartInfo[totalAmount]]"
                                v-model="row.line_total"
                            />
                        </td>
                        <td class="px-1">
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
            <div class="col-md-6 float-right px-0">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">All TotalAmount</label>
                    <div class="col-md-9">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            required
                            name="subtotal"
                            v-model="allTotal"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">disc{{discAs}}</label>
                    <div class="col-md-2">
                        <select
                            type="text"
                            class="form-control"
                            required
                            v-model="discAs"
                            @change="calculateTotal(tabIndex)"
                        >
                            <option>%</option>
                            <option>$</option>
                        </select>
                    </div>
                    <div v-if="discAs === '%'" class="col-md-2">
                        <input
                            type="number"
                            class="form-control"
                            required
                            v-model="disc"
                            @change="calculateTotal(tabIndex)"
                        />
                    </div>
                    <div v-else class="col-md-7">
                        <input
                            type="number"
                            class="form-control"
                            required
                            v-model="disc"
                            @change="calculateTotal(tabIndex)"
                        />
                    </div>
                    <label v-if="discAs === '%'" class="col-md-1 col-form-label">Amt</label>
                    <div v-if="discAs === '%'" class="col-md-4">
                        <input
                            type="number"
                            class="form-control"
                            min="0"
                            step="any"
                            v-model="discC"
                            @change="calculateTotal(tabIndex)"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Vat%</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            class="form-control"
                            required
                            name="vat"
                            v-model="vat"
                            @change="calculateTotal(tabIndex)"
                        />
                    </div>
                    <label class="col-md-1 col-form-label">Vat</label>
                    <div class="col-md-5">
                        <input
                            readonly
                            type="number"
                            class="form-control"
                            name="vatC"
                            v-model="vatC"
                            @change="calculateTotal(tabIndex)"
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
                            required
                            name="total"
                            v-model="finalTotal"
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
                leedId: window.location.href.split('/').pop(),
                tabs: [{
                    ft: 'Ft',
                    selectedHouseType: "",
                    decorTypes: {},
                    descriptions: {},
                    rows: [{
                        operator: 2,
                        selectedDecor: {},
                        selectedDes: "",
                        selectedQty: "",
                        selectedUnit: "",
                        structNos: 0,
                        length: 0,
                        width: 0,
                        height: 0,
                        selectedRate: "",
                        line_total: 0,
                    }],
                }],
                subtotal: 0,
                allTotal: 0,
                finalTotal: 0,
                total: 0,
                vatC: 0,
                vat: 0,
                discC: 0,
                disc: 0,
                discAs: "%",
                tabCounter: 0,
                houseTypes: {},
                subject: {},
                body: {},
                id: {},
                qId: {},
            };
        },
        methods: {
            addRow(tabIndex) {
                this.tabs[tabIndex].rows.push({
                    operator: 2,
                    selectedDecor: {},
                    selectedDes: "",
                    selectedQty: "",
                    selectedUnit: "",
                    structNos: 0,
                    length: 0,
                    width: 0,
                    height: 0,
                    selectedRate: "",
                    line_total: 0,
                });
                localStorage.setItem("rows", JSON.stringify(this.rows));
            },
            addTab() {
                this.tabs.push({
                    ft: 'Ft',
                    selectedHouseType: "",
                    decorTypes: {},
                    descriptions: {},
                    rows: [{
                        operator: 0,
                        selectedDecor: {},
                        selectedDes: "",
                        selectedQty: "",
                        selectedUnit: "",
                        structNos: 0,
                        length: 0,
                        width: 0,
                        height: 0,
                        selectedRate: "",
                        line_total: 0,
                        }
                    ],
                });
                localStorage.setItem("tabs", JSON.stringify(this.tabs));
            },
            getDecor(tabIndex) {
                axios
                    .get("/api/decorTypes", {
                        params: {
                            houseAreaTypeId: this.tabs[tabIndex].selectedHouseType,
                        },
                    })
                    .then(
                        function (response) {
                            console.log(response.data);
                            this.tabs[tabIndex].decorTypes = response.data;
                        }.bind(this)
                    );
            },
            getDescription(tabIndex,rowIndex) {
                axios
                    .get("/api/description", {
                        params: {
                            id: this.tabs[tabIndex].rows[rowIndex].selectedDecor,
                        },
                    })
                    .then(
                        function (response) {
                            console.log(response.data);
                            this.tabs[tabIndex].descriptions = response.data;
                            // console.log(response.data[0].rate);
                            this.tabs[tabIndex].rows[rowIndex].selectedRate =
                                response.data[0].rate;
                            this.tabs[tabIndex].rows[rowIndex].selectedUnit =
                                response.data[0].unit;
                            this.tabs[tabIndex].rows[rowIndex].selectedDes =
                                response.data[0].description;
                        }.bind(this)
                    );
            },
            getHouseTypes() {
                axios.get("/api/houseTypes").then((response) => {
                    this.houseTypes = response.data;
                });
            },
            submit() {
                axios.post('/api/create-cart', {
                    subject   : this.subject,
                    body      : this.body,
                    ht        : this.tabs,
                    finalTotal: this.finalTotal,
                    allTotal  : this.allTotal,
                    vatC      : this.vatC,
                    discC     : this.discC,
                    id     : window.location.href.split('/').pop(),
                    // ht     : Object(this.tabs)
                    // ht     : this.tabs[0].rows[0].selectedDecor
                }).then((response) => {
                    this.id = response.data.id;
                    this.qId = response.data.qId;
                    window.location.href=('/view-cart/'+this.id+'/'+this.qId);
                })
            },
            getSub() {
                axios.get("/api/sub").then((response) => {
                    this.subject = response.data.subject;
                    this.body = response.data.body;
                });
            },
            calculateQty(tabIndex,rowIndex) {
                var operator=parseFloat(this.tabs[tabIndex].rows[rowIndex].operator)
                if (operator === 1) {
                    this.tabs[tabIndex].rows[rowIndex].operator =operator;
                    if (this.tabs[tabIndex].ft === 'Ft'){
                        var total =
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].structNos) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].length) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].width) *
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].height) ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'cubeFt'){
                        total =
                            (parseFloat(this.tabs[tabIndex].rows[rowIndex].structNos) *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].length) *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].height))/1728 ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'Inches'){
                        total =
                            (parseFloat(this.tabs[tabIndex].rows[rowIndex].structNos) *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].length) *
                                parseFloat(this.tabs[tabIndex].rows[rowIndex].height))/144 ;
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }
                }else if(operator ===2){
                    this.tabs[tabIndex].rows[rowIndex].operator =operator;
                    this.tabs[tabIndex].rows[rowIndex].structNos =0;
                    this.tabs[tabIndex].rows[rowIndex].length =0;
                    this.tabs[tabIndex].rows[rowIndex].width =0;
                    this.tabs[tabIndex].rows[rowIndex].height =0;
                    if (this.tabs[tabIndex].ft === 'Ft'){
                        total =
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedQty);
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'cubeFt'){
                        total =
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedQty);
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }else if (this.tabs[tabIndex].ft === 'Inches'){
                        total =
                            parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedQty);
                        if (!isNaN(total)) {
                            this.tabs[tabIndex].rows[rowIndex].selectedQty= total.toFixed(3);
                        }
                    }
                }
                this.calculateTotal(tabIndex, rowIndex);
                this.calculateLineTotal(tabIndex,rowIndex);
            },
            calculateLineTotal(tabIndex,rowIndex) {
                var total =
                    parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedRate) *
                    parseFloat(this.tabs[tabIndex].rows[rowIndex].selectedQty);
                if (!isNaN(total)) {
                    this.tabs[tabIndex].rows[rowIndex].line_total = total.toFixed(2);
                }
                this.calculateTotal();
            },
            calculateTotal(tabIndex,rowIndex) {
                var subtotal=0;
                var allTotal=0;
                var finalTotal=0;
                var total, discC, vatC;
                for (let tabIndex = 0; tabIndex < this.tabs.length; tabIndex++) {
                    subtotal = this.tabs[tabIndex].rows.reduce(function (sum, product) {
                        var lineTotal = parseFloat(product.line_total);
                        if (!isNaN(lineTotal)) {
                            return sum + lineTotal;
                        }
                    }, 0);
                    allTotal += subtotal;
                    console.log(tabIndex,subtotal);
                    //or if you pass float numbers , use parseFloat()
                }
                console.log(allTotal);
                this.allTotal = allTotal.toFixed(2);
                if (this.discAs === '%') {
                    total = allTotal - allTotal * (this.disc / 100);
                    total = parseFloat(total);
                    if (!isNaN(total)) {
                        this.total = total.toFixed(2);
                    } else {
                        this.total = "0.00";
                    }
                    discC  = allTotal * (this.disc / 100);
                    discC = parseFloat(discC);
                    if (!isNaN(discC)) {
                        this.discC = discC.toFixed(2);
                    } else {
                        this.discC = "0.00";
                    }
                }else {
                    total = allTotal - this.disc;
                    total = parseFloat(total);
                    if (!isNaN(total)) {
                        this.total = total.toFixed(2);
                    } else {
                        this.total = "0.00";
                    }
                    discC  = this.disc;
                    discC = parseFloat(discC);
                    if (!isNaN(discC)) {
                        this.discC = discC.toFixed(2);
                    } else {
                        this.discC = "0.00";
                    }
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
            getTabs() {
                if (window.location.href.split('/').pop()){
                    this.tabs = JSON.parse(localStorage.getItem("tabs"));
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
          },
        mounted() {
            this.getHouseTypes();
            if (localStorage.getItem("tabs")) {
                this.getTabs();
            }
            this.getSub();
            this.calculateTotal();
        },
    };
</script>

<style scoped>
</style>
