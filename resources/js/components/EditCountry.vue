<template>


    <div class="container">
        <loader :is-visible="dataReady" v-if="!dataReady"></loader>
        <div class="container" v-if="dataReady">
            <h3 class="text-center">Edit Covid Details for {{ country.name }} As Of {{ currentDate }}</h3>
            <div class="row">
                <div class="col-md-6">
                    <form @submit.prevent="updateCountryDetails">
                        <div class="form-group">
                            <label>New Cases</label>
                            <input type="number" class="form-control" v-model.lazy="newCases">
                        </div>
                        <div class="form-group">
                            <label>Total Cases</label>
                            <input readonly type="number" class="form-control" v-model="actualTotalCases">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button class="btn btn-danger" @click="cancelUpdate()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            country: {},
            dataReady: false,
            newCases: {
                type: Number,
                default: 0
            },
            rawTotalCases: 0,
            actualTotalCases: this.rawTotalCases + this.newCases
            ,
            currentDate: String,
            baseUrl: process.env.MIX_API_BASE_URL
        }
    },
    watch: {
        newCases: {
            handler: function (val) {
                if (val != null && val !== 0 && val !== "") {
                    this.actualTotalCases = parseInt(this.rawTotalCases) + parseInt(val);
                } else {
                    this.actualTotalCases = this.rawTotalCases;
                }
            },
            deep: true,
            immediate: true,
        }

    },
    created() {
        let currentDateWithFormat = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
        this.currentDate = currentDateWithFormat.toString();

        this.axios
            .get(`${this.baseUrl}/country/${this.$route.params.id}`)
            .then((response) => {
                this.dataReady = true;
                this.country = response.data;
                this.calculateTotalCases();
                // console.log(response.data);
            });
    },
    methods: {
        updateCountryDetails() {
            this.country.new_confirmed = this.newCases;
            this.country.total_confirmed = this.actualTotalCases;
            this.axios
                .put(`${this.baseUrl}/country/${this.$route.params.id}`, this.country)
                .then((response) => {
                    this.$router.push({name: 'home'});
                });
        },
        cancelUpdate() {
            this.$router.push({name: 'home'});
        },
        /*
        * Separate the total cases from the new so it can be updated independently
        * */
        calculateTotalCases() {
            this.newCases = this.country.new_confirmed;
            this.rawTotalCases = this.country.total_confirmed - this.newCases;
            this.actualTotalCases = this.newCases + this.rawTotalCases;
        }
    }
}
</script>
