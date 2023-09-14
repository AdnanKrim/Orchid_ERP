<template>
  <div>
    <div class="form-group row">
      <label class="col-md-4 col-form-label">House Area Type</label>
      <div class="col-md-8">
        <select class="form-control select2" id="houseType" required name="houseAreaTypeId" v-model="selectedhouseAreaType">
          <option>Search House type</option>
          <option :value="item.id" v-for="item in houseAreaTypes" :key="item.id">
            {{ item.name }}
          </option>
        </select>
      </div>
    </div>
    <!-- <div class="form-group row">
      <label class="col-md-4 col-form-label">Description</label>
      <div class="col-md-8">
        <div class="mb-3">
          <select
            class="form-select form-select-lg mb-3 form-control"
            id="description"
            name="description"
          ></select>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4 col-form-label">Unit</label>
      <div class="col-md-8">
        <select
          class="form-control form-select form-select-lg mb-3"
          id="unit"
          name="unit"
        ></select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4 col-form-label">Rate</label>
      <div class="col-md-8">
        <select
          class="form-control form-select form-select-lg mb-3"
          id="rate"
          name="rate"
        ></select>
      </div>
    </div> -->
   <div class="form-group">
      <div class="col-sm-10">
        <label for="status">Select descriptions *</label>
        <select class="form-control" v-model="selectedClass">
          <option value="">Select a description</option>
          <option :value="description.id" v-for="description in descriptions" :key="description.id">
            {{ description.description }}
          </option>
        </select>
      </div>
    </div>
    <!-- <div class="form-group">
      <div class="col-sm-10">
        <label for="status">Select Section *</label>
        <select class="form-control" required>
          <option value="">Select a Section</option>
          <option
            v-for="section in sections"
            :key="section.id"
            :value="section.id"
          >
            {{ section.name }}
          </option>
        </select>
      </div>
    </div> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      houseAreaTypes:{},
      descriptions: {},
      selectedhouseAreaType: "",
    };
  },
  methods:{
    loadHouseType(){
            axios.get('/api/house-types').then(response => {
                this.houseAreaTypes = response.data;
                // this.productForm.colors = response.data;
            });
        },
  },
  watch: {
    selectedhouseAreaType: function (value) {
      axios
        .get("/api/descriptions?houseAreaTypeId=" + this.selectedhouseAreaType)
        .then((response) => {
          // console.log(response.data);
          this.descriptions = response.data.data;
        });
    },
  },
  mounted(){
    this.loadHouseType()
  },
};
</script>
