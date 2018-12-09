<template>
    <table class="table table-sm table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Commands</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(option, index) in list" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ option.id }}</td>
                <td>{{ option.name }}</td>
                <td>
                    <button v-on:click="selectItem(option)" v-visible="option.id !== selected" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                    <button v-on:click="editItem(option)" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>
                    <button v-on:click="removeItem(option)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        list: Array,
        selected: null,
        selectedParent: null,
    },
    data() {
        return {};
    },
    methods: {
        selectItem(item) {
            this.$emit('select', item.id);
        },
        editItem(item) {
            this.$emit('edit', item);
        },
        removeItem(item) {
            if(confirm('Sure?')) {
                axios
                    .delete(this.url + '/' + item.id)
                    .then(res => {
                        this.$emit('remove', res.data);
                    });
            }
        },
    },
    computed: {
        url: function() {
            return '/venues/' + this.selectedParent + '/stages';
        }
    }
}
</script>