<template>
    <div>
        <h3 class="text-center">Edit Book</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBook">
                    <div class="form-group">
                        <label>Country Name</label>
                        <input type="text" class="form-control" v-model="country.country_name">
                    </div>
                    <div class="form-group">
                        <label>Total Cases</label>
                        <input type="text" class="form-control" v-model="country.country_total_confirmed">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            country: {}
        }
    },
    created() {
        this.axios
            .get(`http://localhost:9000/api/country/${this.$route.params.id}`)
            .then((response) => {
                this.country = response.data;
                // console.log(response.data);
            });
    },
    methods: {
        updateBook() {
            this.axios
                .post(`http://localhost:9000/api/country/${this.$route.params.id}`, this.country)
                .then((response) => {
                    this.$router.push({name: 'home'});
                });
        }
    }
}
</script>
