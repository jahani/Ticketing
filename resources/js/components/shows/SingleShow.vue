<template>
  <div class="card">
    <img class="card-img-top" :src="event.image" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ event.name }}</h5>
      <h6>{{ event.status }}</h6>
      <date-picker
        v-model="show.start"
        type="datetime"
        format="YYYY-MM-DD HH:mm:ss"
        disabled
        display-format="jYYYY/jMM/jDD HH:mm, dddd"
      >
        <div slot="label">
          <span>
            <i class="fa fa-hourglass-start"></i>
          </span>
        </div>
      </date-picker>
      <date-picker
        v-model="show.end"
        type="datetime"
        format="YYYY-MM-DD HH:mm:ss"
        disabled
        display-format="jYYYY/jMM/jDD HH:mm, dddd"
      >
        <div slot="label">
          <span>
            <i class="fa fa-hourglass-end"></i>
          </span>
        </div>
      </date-picker>
      <small>{{ show.start }}</small>,
      <small>{{ show.end }}</small>
      <p class="card-text">{{ event.description }}</p>
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
