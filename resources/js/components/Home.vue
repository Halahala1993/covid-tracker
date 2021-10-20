<template>
    <div class="container">
        <div id="world-map">
            <maps-component
                :countries="countries"
            ></maps-component>
        </div>
        <hr><br>
        <div id="countries-list">
            <country-component
                :countries="countries"
            ></country-component>
        </div>
    </div>
</template>

<script>
export default {
//    TODO retrieve countries here and pass in to components as param
    data() {
        return {
            countries: [],
        }
    },
    created() {
        this.axios
            .get('http://localhost:9000/api/country')//TODO extract URL to unified location
            .then(response => {
                //TODO add loading screen while data is being retrieved.
                this.countries = response.data;
            });
    },
}
</script>
