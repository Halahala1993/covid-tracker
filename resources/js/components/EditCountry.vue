<template>
    <div>
        <h3 class="text-center">Edit Covid Details for {{country.country_name}} As Of {{currentDate}}</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCountryDetails">
                    <div class="form-group">
                        <!-- TODO decide whether or not to keep new cases-->
                        <label>New Cases</label>
                        <input type="number" class="form-control" v-model="country.country_new_confirmed">
                    </div>
                    <div class="form-group">
                        <label>Total Cases</label>
                        <input type="number" class="form-control" v-model="country.country_total_confirmed">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button class="btn btn-danger" @click="cancelUpdate()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            country: {},
            newCases: Number,
            currentDate: String
        }
    },
    created() {
        let currentDateWithFormat = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
        this.currentDate = currentDateWithFormat.toString();

        this.axios
            .get(`http://localhost:9000/api/country/${this.$route.params.id}`)
            .then((response) => {
                this.country = response.data;
                // console.log(response.data);
            });
    },
    methods: {
        updateCountryDetails() {
            this.axios
                .put(`http://localhost:9000/api/country/${this.$route.params.id}`, this.country)
                .then((response) => {
                    this.$router.push({name: 'home'});
                });
        },
        cancelUpdate(){
            this.$router.push({name: 'home'});
        }
    }
}
</script>
