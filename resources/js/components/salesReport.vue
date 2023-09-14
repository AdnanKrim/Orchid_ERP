<template>
  <div>
    <table class="table table-borderless table-responsive">
      <thead>
        <th class="col-md-4">Date</th>
        <!-- <th class="col-md-2">End Date</th> -->
        <th class="col-md-2">Filter by Client</th>
        <th class="col-md-2">Filter by Branch</th>
        <th class="col-md-2">Filter by Project</th>
      </thead>
      <tbody>
        <td>
          <!-- <Datepicker show-clear-button range v-model="selectedDate" circle lang="en"></Datepicker> -->
          <Datepicker
            v-model="date"
            range
            multiCalendars
            autoApply
            :presetRanges="presetRanges"
            :clearable="false"
            placeholder="Select Date Range"
            :enableTimePicker="false"
            :format-locale="enGB" format="PPP"
          >
            <template #yearly="{ label, range, presetDateRange }">
              <span @click="presetDateRange(range)">{{ label }}</span>
            </template>
          </Datepicker>
          <!-- <input type="date" v-model="startDate" placeholder="First Date" /> -->
        </td>

        <!-- <td> -->
        <!-- <input type="date" v-model="endDate" placeholder="Last Date" /> -->
        <!-- </td> -->

        <td>
          <select v-model="selectedClient">
            <option value="" selected>Select Client Name</option>
            <option v-for="name in clientNames" :key="name" :value="name">
              <p>{{ name }}</p>
            </option>
          </select>
        </td>

        <td>
          <select v-model="selectedBranch">
            <option value="" selected>Select Branch Name</option>
            <option v-for="branch in branchNames" :key="branch" :value="branch">
              {{ branch }}
            </option>
          </select>
        </td>

        <td>
          <select v-model="selectedProject">
            <option value="" selected>Select Project</option>
            <option
              v-for="Project in salesReport"
              :key="Project.id"
              :value="Project.project_name"
            >
              {{ Project.project_name }}
            </option>
          </select>
        </td>
      </tbody>
    </table>

    <table class="table table-borderless table-responsive">
      <thead>
        <th class="col-md-1">Sl</th>
        <th class="col-md-1">Entry Date</th>
        <th class="col-md-2">Invoce No</th>
        <th class="col-md-2">Client Name</th>
        <th class="col-md-2">Project Name</th>
        <th class="col-md-2">Business Branch</th>
        <th class="col-md-2">Amount</th>
      </thead>
      <tbody v-for="(report, reportIndex) in filterItem" :key="reportIndex">
        <td>
          <p>{{ reportIndex + 1 }}</p>
        </td>
        <td>
          <input
            type="date"
            class="form-control text-left"
            v-model="report.date"
          />
        </td>
        <td>
          <input
            class="form-control text-left"
            type="text"
            v-model="report.InvoceNo"
          />
        </td>
        <td>
          <input
            type="name"
            class="form-control text-left"
            v-model="report.client_name"
          />
        </td>
        <td>
          <input
            type="text"
            class="form-control text-left"
            v-model="report.project_name"
          />
        </td>
        <td>
          <input
            type="text"
            class="form-control text-left"
            v-model="report.business_branch"
          />
        </td>
        <td>
          <input
            type="number"
            class="form-control text-left"
            v-model="report.amount"
          />
        </td>
      </tbody>
    </table>
  </div>
</template>

  <script>
import "vue-datepicker-ui/lib/vuedatepickerui.css";
import VueDatepickerUi from "vue-datepicker-ui";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { enGb } from 'date-fns/locale';

import { ref } from "vue";
import {
  endOfMonth,
  endOfYear,
  startOfMonth,
  startOfYear,
  subMonths,
  startOfWeek,
  endOfWeek,
} from "date-fns";
export default {
  components: {
    // Datepicker: VueDatepickerUi,
    Datepicker,
  },

  data() {
    return {
      date: [],
      enGB:'',
      selectedBranch: "",
      selectedClient: "",
      selectedProject: "",
      salesReport: [],
      presetRanges: [
        { label: "Today", range: [new Date(), new Date()] },
        {
          label: "This month",
          range: [startOfMonth(new Date()), endOfMonth(new Date())],
        },
        {
          label: "This Week",
          range: [startOfWeek(new Date()), endOfWeek(new Date())],
        },
        {
          label: "Last month",
          range: [
            startOfMonth(subMonths(new Date(), 1)),
            endOfMonth(subMonths(new Date(), 1)),
          ],
        },
        {
          label: "This year",
          range: [startOfYear(new Date()), endOfYear(new Date())],
        },
        {
          label: "This year (slot)",
          range: [startOfYear(new Date()), endOfYear(new Date())],
          slot: "yearly",
        },
      ],
      selectedDate: [
        // new Date(),
        // new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000)
      ],
    };
  },

  computed: {
    filterItem() {
      let filterClient = this.selectedClient;
      // let startDate = this.localizeDate(this.startDate);
      // let endDate = this.localizeDate(this.endDate);
      let startDate = this.date[0];
      let endDate = this.date[1];
      let filterBranch = this.selectedBranch;
      let filterProject = this.selectedProject;

      const myClientFilterFunction = (item) =>
        filterClient ? item.client_name === filterClient : true;

      const myProjectFilterFunction = (item) =>
        filterProject ? item.project_name === filterProject : true;

      const myBranchFilterFunction = (item) =>
        filterBranch ? item.business_branch === filterBranch : true;

      const myDateFilterFunction = (item) => {
        const itemDate = new Date(item.date);
        if (startDate && endDate) {
          return startDate <= itemDate && itemDate <= endDate;
        }
        if (startDate && !endDate) {
          return startDate <= itemDate;
        }
        if (!startDate && endDate) {
          return itemDate <= endDate;
        }
        return true;
      };

      return this.salesReport
        .filter(myClientFilterFunction)
        .filter(myBranchFilterFunction)
        .filter(myDateFilterFunction)
        .filter(myProjectFilterFunction);
    },

    clientNames() {
      return [
        ...new Set(this.salesReport.map(({ client_name }) => client_name)),
      ];
    },
    branchNames() {
      return [
        ...new Set(
          this.salesReport.map(({ business_branch }) => business_branch)
        ),
      ];
    },
  },

  methods: {
    onClear() {
        this.date = null;
    },
    getSalesReport() {
      axios.get("/api/get-sales-report").then((response) => {
        this.salesReport = response.data;
        console.log(response.data);
      });
    },
    localizeDate(date) {
      if (!date || !date.includes("-")) return date;
      const [yyyy, mm, dd] = date.split("-");
      return new Date(`${mm}/${dd}/${yyyy}`);
    },
    formatDate(date) {
      return new Intl.DateTimeFormat("en-US", { dateStyle: "long" }).format(
        new Date(date)
      );
    },
  },
  mounted() {
    this.getSalesReport();
  },
};
</script>
  <style>
select,
input {
  border: none;
  padding: 10px 7px;
  background-color: #c1c1c1;
  border-radius: 10px;
}
</style>
