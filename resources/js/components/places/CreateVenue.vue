<template>
  <form @submit.prevent="submit()" class="mb-4">
    <div class="form-row align-items-center">
      <div v-if="item.id" class="col-auto">
        <a v-on:click.prevent="resetItem()" href="#" role="button" class="btn btn-secondary">#{{ item.id }}</a>
      </div>
      <div class="col-auto">
        <input v-model="item.name" placeholder="Name" type="text" class="form-control">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  props: {
    item: Object
  },

  data() {
    return {
      url: '/venues',
    };
  },

  methods: {
    submit() {
      if (this.item.hasOwnProperty('id')) {
        this.editItem();
      } else {
        this.createItem();
      }
    },
    setItem(item) {
      this.$emit('item', item);
    },
    resetItem() {
      this.setItem({});
    },
    createItem() {
      axios
        .post(this.url, this.item)
        .then(res => {
          this.resetItem();
          this.$emit('add', res.data);
        });
    },
    editItem() {
      axios
        .put(this.url + '/' + this.item.id, this.item)
        .then(res => {
          this.setItem(res.data);
          this.$emit('edit', res.data);
        });
    },
  },
};
</script>
