<template>
  <div class="container">
    <div class="row">
        <div class="col-auto">
        <div class="form-group form-check">
          <input v-model="imageFilter" type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Image</label>
        </div>
      </div>
      <div class="col-auto">
        <label for="start" class="col-form-label text-md-right">Start after:</label>
      </div>

      <div class="col-auto">
        <date-picker
          v-model="afterFilter"
          :max="beforeFilter"
          type="datetime"
          format="YYYY-MM-DD HH:mm:ss"
          display-format="jYYYY/jMM/jDD HH:mm, dddd"
        ></date-picker>
        {{ afterFilter }}
      </div>
      <div class="col-auto">
        <button v-on:click="afterFilter = ''" class="btn btn-danger">
          <i class="fa fa-minus"></i>
        </button>
      </div>

      <div class="col-auto">
        <label for="start" class="col-form-label text-md-right">Finish before:</label>
      </div>

      <div class="col-auto">
        <date-picker
          v-model="beforeFilter"
          :min="afterFilter"
          type="datetime"
          format="YYYY-MM-DD HH:mm:ss"
          display-format="jYYYY/jMM/jDD HH:mm, dddd"
        ></date-picker>
        {{ beforeFilter }}
      </div>
      <div class="col-auto">
        <button v-on:click="beforeFilter = ''" class="btn btn-danger">
          <i class="fa fa-minus"></i>
        </button>
      </div>
      <div class="col-auto">
        <select v-model="statusFilter" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <option value="" selected>Choose...</option>
            <option v-for="(value, key) in statustypes" :value="key" :key="key" v-if="value !== 'Draft'">
                {{value}}
            </option>
        </select>
      </div>
      <div class="col-auto">
        <select v-model="pageFilter" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <option value="" selected>Page</option>
            <option v-for="(value, key) in totalPages" :value="value" :key="key">
                {{value}}
            </option>
        </select>
      </div>
    </div>

    <div class="row justify-content-center">
      <div v-for="(show, index) in shows" :key="index" class="col-md-4 py-2">
        <single-show :show="show"/>
      </div>
    </div>
  </div>
</template>

<script>
import SingleShow from "./shows/SingleShow";
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
export default {
  props: {
      statustypes: '',
  },

  data() {
    return {
      requestURL: "/shows/api",
      data: [],
      // filters: {
      //     image: false,
      // },
      imageFilter: false,
      afterFilter: "",
      beforeFilter: "",
      statusFilter: "",
      
      pageFilter: 1,
    };
  },

  created() {
    this.fetchShows();
  },

  methods: {
    fetchShows() {
      console.log(this.url);
      axios.get(this.url).then(res => {
        console.log(res);
        this.data = res.data;
      });
    },
    hasFilter(input) {
        return !(input == null || input == "")
    }
  },

  watch: {
    imageFilter: function(input) {
      this.fetchShows();
    },
    afterFilter: function(input) {
      this.fetchShows();
    },
    beforeFilter: function(input) {
      this.fetchShows();
    },
    statusFilter: function(input) {
      this.fetchShows();
    },
    pageFilter: function(input) {
      this.fetchShows();
    },
  },

  computed: {
    url: function() {
      var url = this.requestURL + "?" + $.param(this.filters);
      return url;
    },
    filters: function() {
      var filters = {};

      if (this.imageFilter === true) {
        filters.image = 1;
      }

      if (this.hasFilter(this.afterFilter)) {
        filters.after = this.afterFilter;
      }
      if (this.hasFilter(this.beforeFilter)) {
        filters.before = this.beforeFilter;
      }
      if (this.hasFilter(this.statusFilter)) {
        filters.status = this.statusFilter;
      }
      if (this.hasFilter(this.pageFilter)) {
        filters.page = this.pageFilter;
      }

      return filters;
    },

    shows: function() {
      return this.data.data;
    },

    totalPages: function() {
        if ( (this.data.length != 0) && this.hasFilter(this.data.meta.last_page)) {
            return this.data.meta.last_page;
        }
        return 1;
    },

  },

  components: {
    SingleShow,
    datePicker: VuePersianDatetimePicker,
  }
};
</script>
