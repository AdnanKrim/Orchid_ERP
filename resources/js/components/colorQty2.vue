<template>
    <form action="{{url('api/getArray')}}" method="post">
      <div class="col-md-12">
        <div v-for="(tab, tabIndex) in tabs" :key="tab.id">
          <div>
            <div class="col-md-4 offset-md-4 d-flex">
              <label>HouseAreaTypes</label>
            </div>
            <div class="col-md-4 offset-md-4 d-flex">
              <select
                v-model="tab.selectedHouseType"
                class="form-control select2"
                required
              >
                <option disabled>select</option>
                <option
                  v-for="houseType in houseTypes"
                  :key="houseType.id"
                  :value="houseType.id"
                >
                  {{ houseType.name }}
                </option>
              </select>
              <div class="col-md-4">
                <button
                  v-if="tabIndex == Object.keys(tabs).length - 1"
                  class="btn btn-success btn-sm mt-2 ml-2"
                  @click="addTab"
                >
                  <i class="fa fa-plus"></i>
                </button>
                <button
                  v-if="tabIndex != 0"
                  class="btn btn-danger btn-sm mt-2 ml-2"
                  @click="removeTab(tabIndex, tab)"
                >
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
          </div>
          <div v-for="(row, rowIndex) in tab.rows" :key="row.id">
            <div>
              <div class="col-md-3 d-flex">
                <label>Decoration Types</label>
              </div>
              <div class="col-md-2 d-flex">
                <select
                  v-model="row.selectedDecor"
                  class="form-control select2"
                  required
                >
                  <option disabled>select</option>
                  <option>ppp</option>
                  <option
                    v-for="decorType in decorTypes"
                    :key="decorType.id"
                    :value="decorType.id"
                  >
                    {{ decorType.name }}
                  </option>
                </select>

                <div class="col-md-3 d-flex">
                  <button
                    v-if="rowIndex == Object.keys(tab.rows).length - 1"
                    class="btn btn-success btn-sm mt-2 ml-2"
                    @click="addRow(tabIndex)"
                  >
                    <i class="fa fa-plus"></i>
                  </button>
                  <button
                    v-if="rowIndex != 0"
                    class="btn btn-danger btn-sm mt-2 ml-2"
                    @click="removeRow(rowIndex, row, tabIndex)"
                  >
                    <i class="fa fa-minus"></i>
                  </button>
                </div>
                <hr />
              </div>
            </div>
            <hr />
            <div class="col-md-10 float-right">
              <table class="table table-borderless col-md-12">
                <thead>
                  <th class="col-md-1"></th>
                  <th class="col-md-1">System</th>
                  <th class="col-md-1">Color</th>
                  <th class="col-md-1">StructNos</th>
                  <th class="col-md-1">Length(sft)</th>
                  <th class="col-md-1">Width(sft)</th>
                  <th class="col-md-1">Quantity</th>
                  <th class="col-md-1"></th>
                </thead>
                <tbody v-for="(line, lineIndex) in row.lines" :key="line.id">
                  <td class="">
                    <select
                      class="form-control"
                      v-model="line.operator"
                      @change="calculateQty(tabIndex, rowIndex, lineIndex)"
                    >
                      <option selected value="2">+</option>
                      <option value="1">-</option>
                    </select>
                  </td>
                  <td class="">
                    <select
                      v-model="line.system"
                      @change="calculateQty(tabIndex, rowIndex, lineIndex)"
                      class="form-control"
                    >
                      <option value="1">Automatic</option>
                      <option value="2">Manual</option>
                    </select>
                  </td>
                  <td class="">
                    <div>
                      <select
                        class="form-control select2"
                        v-model="line.selectedColor"
                        @change="chooseColor(tabIndex, rowIndex, lineIndex)"
                      >
                        <option disabled>select</option>
                        <option
                          v-for="color in allColors"
                          :key="color.id"
                          :value="color.color"
                        >
                          {{ color.color }}
                        </option>
                      </select>
                    </div>
                  </td>
                  <td class="">
                    <div>
                      <input
                        v-model="line.structNos"
                        @change="calculateQty(tabIndex, rowIndex, lineIndex)"
                        class="form-control text-right"
                        type="number"
                      />
                    </div>
                  </td>
                  <td class="">
                    <div>
                      <input
                        v-model="line.length"
                        @change="calculateQty(tabIndex, rowIndex, lineIndex)"
                        class="form-control text-right"
                        type="number"
                      />
                    </div>
                  </td>
                  <td class="">
                    <div>
                      <input
                        v-model="line.width"
                        @change="calculateQty(tabIndex, rowIndex, lineIndex)"
                        class="form-control text-right"
                        type="number"
                      />
                    </div>
                  </td>
                  <td class="">
                    <div>
                      <input
                        v-model="line.selectedQty"
                        class="form-control text-right"
                        type="number"
                      />
                    </div>
                  </td>
                  <td class="">
                    <button
                      v-if="lineIndex == Object.keys(row.lines).length - 1"
                      type="button"
                      class="btn btn-success btn-sm mt-2 mr-1"
                      @click="addLine(lineIndex, tabIndex, rowIndex)"
                    >
                      <i class="fa fa-plus"></i>
                    </button>
                    <button
                      v-if="lineIndex != 0"
                      type="button"
                      class="btn btn-danger btn-sm mt-2"
                      @click="
                        removeLine(rowIndex, row, tabIndex, line, lineIndex)
                      "
                    >
                      <i class="fa fa-minus"></i>
                    </button>
                  </td>
                </tbody>
              </table>
              <hr />
            </div>
          </div>
        </div>
        <table class="table table-borderless col-md-8">
          <thead>
            <th class="col-md-2">Color</th>
            <th class="">Rate</th>
            <th class="col-md-1">Qty</th>
            <th class="col-md-1">Total</th>
          </thead>
          <tbody v-for="(color, colorIndex) in FilteredColor" :key="color">
            <td>
              <input
                type="text"
                class="form-control text-left"
                v-model="color.selectedColor"
              />
            </td>
            <td class="col-md-1">
              <input
                class="form-control text-right"
                type="number"
                v-model="color.selectedRate"
                @input="quantity(colorIndex)"
              />
            </td>
            <td>
              <input
                type="number"
                class="form-control text-right"
                v-model="color.selectedQty"
              />
            </td>
            <td>
              <input
                class="form-control text-right"
                :value="
                  (color.line_total = color.selectedRate * color.selectedQty)
                "
                type="number"
                min="0"
              />
            </td>
          </tbody>
        </table>
        <div class="col-md-6 float-right px-0">
          <div class="form-group row">
            <label class="col-md-3 col-form-label">All TotalAmount</label>
            <div class="col-md-9">
              <input readonly type="number" class="form-control" required />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label">disc</label>
            <div class="col-md-2">
              <select type="text" class="form-control" required>
                <option>%</option>
                <option>$</option>
              </select>
            </div>
            <!-- <div v-if="discAs === '%'" class="col-md-2">
                        <input type="number" class="form-control" required />
                      </div>
                      <div v-else class="col-md-7">
                        <input type="number" class="form-control" required />
                      </div>
                      <label v-if="discAs === '%'" class="col-md-1 col-form-label"
                        >Amt</label
                      >
                      <div v-if="discAs === '%'" class="col-md-4">
                        <input type="number" class="form-control" min="0" step="any" />
                      </div> -->
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label">Vat%</label>
            <div class="col-md-3">
              <input type="number" class="form-control" required name="vat" />
            </div>
            <label class="col-md-1 col-form-label">Vat</label>
            <div class="col-md-5">
              <input readonly type="number" class="form-control" />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label">Grand Total</label>
            <div class="col-md-9">
              <input readonly type="number" class="form-control" required />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 float-right">
        <input type="submit" @click="submit" class="btn btn-success" />
      </div>
    </form>
  </template>

  <script type="module">
  export default {
    data() {
      return {
        tabs: [
          {
            selectedHouseType: "select",
            rows: [
              {
                selectedDecor: "select",
                color: "",
                rowQty: 0,
                rowTotal: 0,
                rate: 0,
                lines: [
                  {
                    operator: 2,
                    system: 1,
                    selectedColor: "select",
                    selectedQty: 0,
                    selectedUnit: "",
                    structNos: 0,
                    length: 0,
                    width: 0,
                    selectedRate: "",
                    line_total: 0,
                  },
                ],
              },
            ],
          },
        ],
        houseTypes: {},
        decorTypes: {},
        allColors: {},
        grouped: {},
        halfQty: 0,
        FilteredColor: [],
        ColorwithRate: [],
      };
    },
    computed: {
      // getGrouped() {
      //   let ColorwithRate = [];
      //   this.FilteredColor.forEach((c, index) => {
      //     //  c.selectedRate = 34;
      //     // console.log(this.getGrouped[index])
      //     let rate = 0;

      //     this.getGrouped.forEach((obj) => {
      //       rate = obj.selectedRate;
      //     });
      //     console.log(rate);
      //     if (rate == c.selectedRate) {
      //       c.selectedRate = rate;
      //     }
      //     ColorwithRate.push(c);
      //   });

      //   return ColorwithRate;
      // },
    },

    methods: {
      chooseColor(tabIndex, rowIndex, lineIndex) {
        this.FilteredColor.forEach((f) => {
          if (
            f.selectedColor ===
            this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].selectedColor
          ) {
            this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].selectedRate =
              f.selectedRate;
          }
        });
        const lineColors = this.tabs.flatMap((t) =>
          t.rows.flatMap((r) => r.lines)
        );
        // console.log(lineColors)
        this.ColorwithRate = lineColors;
        const data = { colors: this.ColorwithRate };
        const result = data.colors.reduce(
          (acc, { selectedColor: sc, selectedQty: sq, selectedRate: sr }) => {
            if (acc[sc])
              return {
                ...acc,
                [sc]: {
                  selectedColor: sc,
                  selectedQty: acc[sc].selectedQty + parseFloat(sq),
                  selectedRate: sr,
                },
              };
            return {
              ...acc,
              [sc]: {
                selectedColor: sc,
                selectedQty: parseFloat(sq),
                selectedRate: sr,
              },
            };
          },
          {}
        );
        this.FilteredColor = Object.values(result);
      },
      quantity(colorIndex) {
        this.FilteredColor[colorIndex].line_total =
          this.FilteredColor[colorIndex].selectedRate *
          this.FilteredColor[colorIndex].selectedQty;
        // console.log(this.ColorwithRate);
        this.ColorwithRate.forEach((color, index) => {
          if (
            color.selectedColor == this.FilteredColor[colorIndex].selectedColor
          ) {
            color.selectedRate = this.FilteredColor[colorIndex].selectedRate;
          }
        });
      },
      submit() {
        console.log(this.FilteredColor);
      },
      getHouseTypes() {
        axios.get("/api/pb/get/house/area/types").then((response) => {
          this.houseTypes = response.data;
        });
      },
      getDecorTypes() {
        axios.get("/api/pb/get/decoration/types").then((response) => {
          this.decorTypes = response.data;
        });
      },
      getColors() {
        axios.get("/api/pb/get/color").then((response) => {
          this.allColors = response.data;
          // console.log(this.allColors);
        });
      },
      calculateQty(tabIndex, rowIndex, lineIndex) {
        var system = parseFloat(
          this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].system
        );
        if (system === 1) {
          this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].system = system;
          var operator = parseFloat(
            this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].operator
          );
          var structNos0 =
            this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].structNos;
          if (operator === 1) {
            this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].operator =
              operator;
            if (structNos0 > 0) {
              var structNos1 = structNos0 * -1;
              this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].structNos =
                structNos0 * -1;
            } else if (structNos0 < 0) {
              structNos1 = structNos0 * 1;
              this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].structNos =
                structNos0 * 1;
            }
            var total =
              structNos1 *
              parseFloat(
                this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].length
              ) *
              parseFloat(
                this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].width
              );
            console.log(total);
            if (!isNaN(total)) {
              this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].selectedQty =
                total.toFixed(2);
            }
          } else if (operator === 2) {
            this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].operator =
              operator;
            if (structNos0 > 0) {
              var structNos2 = structNos0 * 1;
              this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].structNos =
                structNos0 * 1;
            } else if (structNos0 < 0) {
              structNos2 = structNos0 * -1;
              this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].structNos =
                structNos0 * -1;
            }
            total =
              structNos2 *
              parseFloat(
                this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].length
              ) *
              parseFloat(
                this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].width
              );
            // console.log(total);
            if (!isNaN(total)) {
              this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].selectedQty =
                total.toFixed(2);
            }
          }
        } else if (system === 2) {
          this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].system = system;
          this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].structNos = 0;
          this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].length = 0;
          this.tabs[tabIndex].rows[rowIndex].lines[lineIndex].width = 0;
        }
        this.calculateTotal(tabIndex, rowIndex, lineIndex);
        this.chooseColor(tabIndex, rowIndex, lineIndex);
        //   this.quantity();
      },
      calculateTotal() {
        // axios.post('/api/getArray', {
        //     info        : this.FilteredColor,
        // }).then((response) => {
        //     console.log(response.data);
        // })
      },
      addLine(lineIndex, tabIndex, rowIndex) {
        this.tabs[tabIndex].rows[rowIndex].lines.push({
          operator: 2,
          system: 1,
          selectedColor: "",
          selectedQty: "",
          selectedUnit: "",
          structNos: 0,
          length: 0,
          width: 0,
          selectedRate: "",
          line_total: 0,
        });
        localStorage.setItem("lines", JSON.stringify(this.lines));
      },
      addRow(tabIndex) {
        this.tabs[tabIndex].rows.push({
          selectedDecor: "select",
          color: "",
          rowQty: 0,
          rowTotal: 0,
          rate: 0,
          lines: [
            {
              operator: 2,
              system: 1,
              selectedColor: "select",
              selectedQty: 0,
              selectedUnit: "",
              structNos: 0,
              length: 0,
              width: 0,
              selectedRate: "",
              line_total: 0,
            },
          ],
        });
        localStorage.setItem("rows", JSON.stringify(this.rows));
      },
      addTab() {
        this.tabs.push({
          selectedHouseType: "select",
          rows: [
            {
              selectedDecor: "select",
              color: "",
              rowQty: 0,
              rowTotal: 0,
              rate: 0,
              lines: [
                {
                  operator: 2,
                  system: 1,
                  selectedColor: "select",
                  selectedQty: 0,
                  selectedUnit: "",
                  structNos: 0,
                  length: 0,
                  width: 0,
                  selectedRate: "",
                  line_total: 0,
                },
              ],
            },
          ],
        });
        localStorage.setItem("tabs", JSON.stringify(this.tabs));
      },
      removeLine(rowIndex, row, tabIndex, line, lineIndex) {
        var idx = this.tabs[tabIndex].rows[rowIndex].lines.indexOf(line);
        console.log(idx, rowIndex);
        if (lineIndex != 0) {
          this.tabs[tabIndex].rows[rowIndex].lines.splice(idx, 1);
          localStorage.setItem("lines", JSON.stringify(this.lines));
        }
      },
      removeRow(rowIndex, row, tabIndex) {
        var idx = this.tabs[tabIndex].rows.indexOf(row);
        // console.log(idx, rowIndex);
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
      },
      getTabs() {
        if (window.location.href.split("/").pop()) {
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
      if (localStorage.getItem("tabs")) {
        this.getTabs();
      }
      this.getHouseTypes();
      this.getDecorTypes();
      this.getColors();
      this.calculateTotal();
      this.chooseColor();
    },
  };
  </script>
  <style scoped>
  </style>
