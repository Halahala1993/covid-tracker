<template>
    <div class="container">

        <div v-if="!dataReady"
             class="d-flex justify-content-center"
             style="min-height: 75%; min-height: 75vh;
              display: flex; align-items: center;">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <maps-component :countries="countries" v-if="dataReady"
        ></maps-component>
        <hr>
        <br>
        <global-stats-component :countries="countries" v-if="dataReady"
        ></global-stats-component>
        <hr>
        <country-component :countries="countries" v-if="dataReady"
        ></country-component>
    </div>
</template>

<script>

export default {

    data() {
        return {
            countries: [],
            dataReady: false,
            baseUrl: process.env.MIX_API_BASE_URL
        }
    },
    created() {
        this.axios
            .get(this.baseUrl + '/country')
            .then(response => {
                this.countries = response.data;
                this.dataReady = true;
            });
    },
}
</script>
