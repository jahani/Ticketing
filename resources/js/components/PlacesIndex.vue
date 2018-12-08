<template>
    <div>

        <h1>Venues</h1>
        <select v-model="selectedVenue" class="form-control">
            <option value="null" disabled>Select an option</option>
            <option v-for="option in venues" :key="option.id" :value="option.id">
                {{ option.name }}
            </option>
        </select>
        <venues-table
            v-bind:list="venues"
            @select="selectVenue"
        />

        <h1 v-if="selectedVenue">
            Stages
            <small>for {{ getObjectByID(venues, selectedVenue).name }}</small>
        </h1>
        <stages-table
            v-show="selectedVenue"
            v-bind:list="stages"
            @select="selectStage"
        />

        <h1 v-if="selectedStage">
            Sections
            <small>for {{ getObjectByID(stages, selectedStage).name }}</small>
        </h1>
        <sections-table
            v-show="selectedStage"
            v-bind:list="sections"
            @select="selectSection"
        />

        <h1 v-if="selectedSection">
            Seats
            <small>for {{ getObjectByID(sections, selectedSection).name }}</small>
        </h1>
        <seats-table
            v-show="selectedSection"
            v-bind:list="seats"
            @select="selectSeat"
        />
    </div>
</template>

<script>
import VenuesTable from './places/VenuesTable';
import StagesTable from './places/StagesTable';
import SectionsTable from './places/SectionsTable';
import SeatsTable from './places/SeatsTable';
export default {
    props: {},

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
        getObject(array, key, value) {
            return array.find(obj => obj[key] == value);
        },
        getObjectByID(array, value) {
            return this.getObject(array, 'id', value);
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

    components: {
        VenuesTable,
        StagesTable,
        SectionsTable,
        SeatsTable,
    }
}
</script>
