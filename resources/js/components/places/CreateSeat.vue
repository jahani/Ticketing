<template>
  <div>
    <div v-show="error" class="alert alert-danger" role="alert">{{ error }}</div>
    <div v-if="seats && seats.length">
      There are {{ seats.length }} seats in this section.
      <button
        class="btn btn-danger my-2"
        v-on:click="remove()"
      >Remove All</button>
    </div>
    <div v-else>
      <div v-for="(row, index) in rows" :key="index" class="form-group row">
        <label v-bind:for="'row-' + index" class="col-sm-4 col-form-label">Row #{{ index+1 }}</label>
        <div class="col-sm-4">
          <input
            type="number"
            v-model="row.value"
            class="form-control"
            placeholder="Seat Numbers"
          >
        </div>
        <div class="col-sm-4">
          <button v-on:click="removeRow(index)" class="btn">Remove</button>
        </div>
      </div>
      <button class="btn btn-secondary btn-block" v-on:click="addRow()">Add Row</button>
      <button class="btn btn-primary my-2" v-on:click="submit()">Submit</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    section_id: null,
    seats: Array
  },

  data() {
    return {
      rows: [{ value: 8 }, { value: 8 }, { value: 8 }],
      error: null
    };
  },

  created() {},

  methods: {
    addRow() {
      this.rows.push({ value: 8 });
    },
    removeRow(index) {
      this.rows.splice(index, 1);
    },
    submit() {
      this.resetError();
      axios
        .post("/seatfactory/" + this.section_id, {
          rows: this.rowsArray
        })
        .then(res => {
          if (res.data.ok) {
            this.setSeats(res.data.seats);
          } else {
            this.setError(res.data.error);
          }
        });
    },
    remove() {
      this.resetError();
      axios
        .delete("/seatfactory/" + this.section_id, {
          rows: this.rowsArray
        })
        .then(res => {
          if (res.data.ok) {
            this.setSeats([]);
          } else {
            this.setError(res.data.error);
          }
        });
    },
    setSeats(seats) {
      this.$emit("seats", seats);
    },

    setError(error) {
      this.error = error;
    },
    resetError() {
      this.error = null;
    }
  },

  computed: {
    rowsArray: function() {
      return this.rows.map(obj => obj.value);
    }
  }
};
</script>
