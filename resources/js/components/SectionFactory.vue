<template>
    <div v-if="showForm">
        <div>
            <div v-for="(row, index) in rows" class="form-group row">
                <label v-bind:for="'row-' + index" class="col-sm-4 col-form-label">Row #{{ index+1 }}</label>
                <div class="col-sm-4">
                    <input type="number" v-model:value="row.value" class="form-control" v-bind:id="'row-' + index" placeholder="Seat Numbers">
                </div>
                <div class="col-sm-4">
                    <button v-on:click="removeRow(index)" class="btn">Remove</button>
                </div>
            </div>
        </div>
        <button class="btn btn-secondary btn-block" v-on:click="addRow()">Add Row</button>
        <button class="btn btn-primary my-2" v-on:click="submit()">Submit</button>
    </div>
    <div v-else class="alert alert-info">
        Submited.
    </div>
</template>

<script>
    export default {
        props: {
            section_id: '',
        },

        data() {
            return {
                rows: [{'value': 8}, {'value': 8}, {'value': 8}],
                showForm: true
            };
        },

        created() {},

        methods: {
            addRow() {
                this.rows.push({value: 8});
            },
            removeRow(index) {
                this.rows.splice(index, 1);
            },
            submit() {
                fetch('/api/seatfactory/' + this.section_id, {
                    method: 'post',
                    body: JSON.stringify(this.rows),
                    headers: {
                        'content-type': 'application/json'
                }})
                .then(res => res.json())
                .then(res => {
                    this.showForm = false
                    console.log(res.data)
                })
                .catch(err => console.log(err));
            }
        },

        mounted() {
            console.log('Section Factory Component mounted.')
        }
    }
</script>
