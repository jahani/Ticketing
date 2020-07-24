<template>
  <div class="seats" v-if="seats.length > 0">
    <div
      v-for="(n, i) in colsNum"
      :key="'cols' + i"
      class="cols"
      :style="{ 'grid-row': 1, 'grid-column': n+1 }"
    >-</div>

    <div
      v-for="(n, i) in rowsNum"
      :key="'rows' + i"
      class="rows"
      :style="{ 'grid-row': n+1, 'grid-column': 1 }"
    >{{n}}</div>

    <a
      v-for="(seat, index) in seats"
      :id="'seat-' + seat.id"
      :key="index"
      :style="{ 'grid-row': Number(seat.row_number)+1, 'grid-column': Number(seat.seat_number)+1 }"
      v-on:click.prevent
      role="button" class="seat btn btn-secondary"
      href="#"
      v-tooltip:top="getSeatTooltip(seat)"
      data-html="true"
    >{{ seat.seat_number }}</a>
  </div>
</template>

<script>
export default {
  props: {
    seats: Array
  },
  data() {
    return {};
  },
  methods: {
      getSeatTooltip(seat) {
          return 'Row: ' + seat.row_number +'<br>Seat: ' + seat.seat_number;
      }
  },
  computed: {
    rowsNum: function() {
      if (this.seats.length > 0) {
        return Math.max.apply(Math, this.seats.map(o => o.row_number));
      } else {
        return 1;
      }
    },
    colsNum: function() {
      if (this.seats.length > 0) {
        return Math.max.apply(Math, this.seats.map(o => o.seat_number));
      } else {
        return 1;
      }
    }
  }
};
</script>