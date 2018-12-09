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
            :list="venues"
            :selected="selectedVenue"
            @select="selectVenue"
            @edit="goEdit('venue', $event)"
            @remove="remove(venues, $event)"
        />
        <create-venue
            :item="venue"
            @item="venue = $event"
            @add="add(venues, $event)"
            @edit="edit(venues, $event)"
        />

        <h1 v-if="selectedVenue">
            Stages
            <small>for {{ getObjectByID(venues, selectedVenue).name }}</small>
        </h1>
        <stages-table
            v-show="selectedVenue"
            :selectedParent="selectedVenue"
            :list="stages"
            :selected="selectedStage"
            @select="selectStage"
            @edit="goEdit('stage', $event)"
            @remove="remove(stages, $event)"
        />
        <create-stage
            v-show="selectedVenue"
            :selectedParent="selectedVenue"
            :item="stage"
            @item="stage = $event"
            @add="add(stages, $event)"
            @edit="edit(stages, $event)"
        />

        <h1 v-if="selectedStage">
            Sections
            <small>for {{ getObjectByID(stages, selectedStage).name }}</small>
        </h1>
        <sections-table
            v-show="selectedStage"
            :selectedParent="selectedStage"
            :list="sections"
            :selected="selectedSection"
            @select="selectSection"
            @edit="goEdit('section', $event)"
            @remove="remove(sections, $event)"
        />
        <create-section
            v-show="selectedStage"
            :selectedParent="selectedStage"
            :item="section"
            @item="section = $event"
            @add="add(sections, $event)"
            @edit="edit(sections, $event)"
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
import CreateVenue from './places/CreateVenue';
import CreateStage from './places/CreateStage';
import CreateSection from './places/CreateSection';

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

            venue: {},
            stage: {},
            section: {},
            seat: {},
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
            });
        },
        fetchStages(id) {
            var url = '/venues/' + id + '/stages';
            axios.get(url)
            .then(res => {
                this.stages = res.data;
            });
        },
        fetchSections(id) {
            var url = '/stages/' + id + '/sections';
            axios.get(url)
            .then(res => {
                this.sections = res.data;
            });
        },
        fetchSeats(id) {
            var url = '/sections/' + id + '/seats';
            axios.get(url)
            .then(res => {
                this.seats = res.data;
            });
        },
        getObject(array, key, value) {
            return array.find(obj => obj[key] == value);
        },
        getObjectByID(array, value) {
            return this.getObject(array, 'id', value);
        },
        getIndex(array, key, value) {
            return _.findKey(array, obj => obj[key] == value);
        },
        getIndexByID(array, value) {
            return this.getIndex(array, 'id', value);
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
            this.resetSeats();
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

        goEdit(itemName, editItem) {
            this[itemName] = Object.assign({}, editItem);
        },

        // UI Functions
        add(list, item) {
            list.push(item);
        },
        edit(list, item) {
            var index = this.getIndexByID(list, item.id);
            Vue.set(list, index, Object.assign({}, item));
        },
        remove(list, item) {
            var index = this.getIndexByID(list, item.id);
            Vue.delete(list, index);
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
        CreateVenue,
        CreateStage,
        CreateSection,

        VenuesTable,
        StagesTable,
        SectionsTable,
        SeatsTable,
    }
}
</script>
