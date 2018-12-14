<template>
  <div class="card">
    <img class="card-img-top" :src="event.image" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ event.name }}</h5>
      <h6>{{ event.status }}</h6>
      <small>{{ show.start }}</small>,
      <small>{{ show.end }}</small>
      <p class="card-text">{{ event.description }}</p>
      <a :href="'/shows/' + show.id" class="btn btn-primary">More Info</a>
    </div>
  </div>
</template>

<script>
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
    },
  }
};
</script>
