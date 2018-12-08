<template>
    <div>

        <h1>Venues</h1>
        <select v-model="selectedVenue" class="form-control">
            <option value="null" disabled>Select an option</option>
            <option v-for="option in venues" v-bind:value="option.id">
                {{ option.name }}
            </option>
        </select>
        <venues-table
            v-bind:list="venues"
            @select="selectVenue"
        />

        <h1 v-show="selectedVenue">Stages <small v-if="selectedVenue !== null">for {{ getVenue(selectedVenue).name }}</small></h1>
        <stages-table
            v-show="selectedVenue"
            v-bind:list="stages"
            @select="selectStage"
        />

        <h1 v-show="selectedStage">Sections <small v-if="selectedStage !== null">for {{ getStage(selectedStage).name }}</small></h1>
        <sections-table
            v-show="selectedStage"
            v-bind:list="sections"
            @select="selectSection"
        />

        <h1 v-show="selectedSection">Seats <small v-if="selectedSection !== null">for {{ getSection(selectedSection).name }}</small></h1>
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
    },

    components: {
        VenuesTable,
        StagesTable,
        SectionsTable,
        SeatsTable,
    }
}
</script>
