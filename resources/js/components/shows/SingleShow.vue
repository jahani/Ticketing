<template>
  <div class="card">
    <img class="card-img-top" :src="event.image" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ event.name }}</h5>
      <h6>{{ event.status }}</h6>
      <div>
        <small>{{ show.start | moment }}</small>
      </div>
      <div>
        <small>{{ show.end | moment }}</small>
      </div>
      <div class="card-text">
        <p>{{ event.description }}</p>
        <div v-for="venue in show.venues" :key="venue.id" class="venue">
          <i class="fa fa-map-marker"></i> {{venue.name}}
        </div>
      </div>
      <a :href="'/shows/' + show.id" class="btn btn-primary">More Info</a>
    </div>
  </div>
</template>

<script>
import VuePersianDatetimePicker from "vue-persian-datetime-picker";
export default {
  props: {
    show: Object
  },

  data() {
    return {};
  },

  filters: {
    moment: function(date) {
      return moment(date).format("jYYYY/jMM/jDD HH:mm, dddd");
    }
  },

  computed: {
    event: function() {
      return this.show.event;
    }
  },
  components: {
    datePicker: VuePersianDatetimePicker
  }
};
</script>
