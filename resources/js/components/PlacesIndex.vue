<template>
    <div>

        <h1>Venues</h1>
        <select v-model="selectedVenue" class="form-control">
            <option value="null" disabled>Select an option</option>
            <option v-for="option in venues" v-bind:value="option.id">
                {{ option.name }}
            </option>
        </select>
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
                <tr v-for="(option, index) in venues">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ option.id }}</td>
                    <td>{{ option.name }}</td>
                    <td>
                        <button v-on:click="selectVenue(option.id)" v-visible="option.id !== selectedVenue" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                        <button v-on:click="editVenue(option.id)" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>
                        <button v-on:click="deleteVenue(option.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

        <h1>Stages <small v-if="selectedVenue !== null">for {{ getVenue(selectedVenue).name }}</small></h1>
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
                <tr v-for="(option, index) in stages">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ option.id }}</td>
                    <td>{{ option.name }}</td>
                    <td>
                        <button v-on:click="selectStage(option.id)" v-visible="option.id !== selectedStage" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                        <button v-on:click="editStage(option.id)" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>
                        <button v-on:click="deleteStage(option.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

        <h1>Sections <small v-if="selectedStage !== null">for {{ getStage(selectedStage).name }}</small></h1>
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
                <tr v-for="(option, index) in sections">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ option.id }}</td>
                    <td>{{ option.name }}</td>
                    <td>
                        <button v-on:click="selectSection(option.id)" v-visible="option.id !== selectedSection" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                        <button v-on:click="editSection(option.id)" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>
                        <button v-on:click="deleteSection(option.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

        <h1>Seats <small v-if="selectedSection !== null">for {{ getSection(selectedSection).name }}</small></h1>
        <table class="table table-sm table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Row/Col</th>
                    <th scope="col">Commands</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(option, index) in seats">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ option.id }}</td>
                    <td>{{ option.row_number }}/{{ option.seat_number }}</td>
                    <td>
                        <button v-on:click="selectSeat(option.id)" v-visible="option.id !== selectedSeat" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                        <button v-on:click="editSeat(option.id)" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>
                        <button v-on:click="deleteSeat(option.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            
        },

        data() {
            return {
                venues: [],
                selectedVenue: null,
                stages: [],
                selectedStage: null,
                sections: [],
                selectedSection: null,
                seats: [],
                selectedSeat: null,
            };
        },

        created() {
            this.fetchVenues();
        },

        methods: {
            fetchVenues() {
                axios.get('/venues')
                .then(res => {
                    this.venues = res.data;
                    console.log(res.data);
                });
            },
            fetchStages(id) {
                var url = '/venues/' + id + '/stages';
                axios.get(url)
                .then(res => {
                    this.stages = res.data;
                    console.log(res.data);
                });
            },
            fetchSections(id) {
                var url = '/stages/' + id + '/sections';
                axios.get(url)
                .then(res => {
                    this.sections = res.data;
                    console.log(res.data);
                });
            },
            fetchSeats(id) {
                var url = '/sections/' + id + '/seats';
                axios.get(url)
                .then(res => {
                    this.seats = res.data;
                    console.log(res.data);
                });
            },
            getVenue(id) {
                return this.venues.find(obj => obj.id == id);
            },
            getStage(id) {
                return this.stages.find(obj => obj.id == id);
            },
            getSection(id) {
                return this.sections.find(obj => obj.id == id);
            },
            getSeat(id) {
                return this.seats.find(obj => obj.id == id);
            },
            selectVenue(id) {
                this.resetStages();
                this.selectedVenue = id;
            },
            selectStage(id) {
                this.resetSections();
                this.selectedStage = id;
            },
            selectSection(id) {
                this.selectedSection = id;
            },
            selectSeat(id) {
                this.selectedSeat = id;
            },
            resetStages() {
                this.resetSections();
                this.selectedStage = null;
                this.stages = [];
            },
            resetSections() {
                this.resetSeats();
                this.selectedSection = null;
                this.sections = [];
            },
            resetSeats() {
                this.selectedSeat = null;
                this.seats = [];
            },
        },

        watch: {
            selectedVenue: function(id) {
                if (id !== null) {
                    this.fetchStages(id);
                }
            },
            selectedStage: function(id) {
                if (id !== null) {
                    this.fetchSections(id);
                }
            },
            selectedSection: function(id) {
                if (id !== null) {
                    this.fetchSeats(id);
                }
            },
        },

        mounted() {
            console.log('Sections Index Component mounted.')
        }
    }
</script>
