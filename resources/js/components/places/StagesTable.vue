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
            <tr v-for="(option, index) in list" :key="option.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ option.id }}</td>
                <td>{{ option.name }}</td>
                <td>
                    <button v-on:click="selectItem(option.id)" v-visible="option.id !== selected" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                    <button v-on:click="editItem(option.id)" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>
                    <button v-on:click="deleteItem(option.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        list: Array,
    },
    data() {
        return {
            selected: null,
        };
    },
    methods: {
        selectItem(id) {
            this.selected = id;
            this.$emit('select', id);
        },
    }
}
</script>