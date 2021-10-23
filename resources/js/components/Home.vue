<template>
    <div class="container">

        <loader :is-visible="dataReady" v-if="!dataReady"></loader>

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
