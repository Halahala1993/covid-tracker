<template>
    <div class="wrapper">
<!--        <themap :countryData="countryData1"></themap>-->
<!--        <themap :countryData="countryData1" @mouseleave="on_mouseleave" @mouseenter="on_mouseenter" />-->
        <maps-component
            :country-data="countryData"
            :show-overlay="showMapOverlay"
            :countryColors="false"
            :lowColor="blue"
            :highColor="red"
            @mouseenter="onMouseEnterMapCountry"
            @mouseleave="onMouseLeaveMapCountry"
            @click="onClickMapCountry"
        >
            <template v-slot:overlay>
                {{countryName}}'s Total Case Count: {{totalCaseCount}}
            </template>
        </maps-component>
    </div>
</template>
<script>
import Vue from 'vue';
export default Vue.extend({
    data: function() {
        return {
            countryData: {
                US: 100,
                CA: 200,
                GB: 500,
            },
            countries: [],
            totalCaseCount: 0,
            countryName: '',
            showMapOverlay: false
        };
    },
    created() {
        this.axios
            .get('http://localhost:9000/api/country')
            .then(response => {
                this.countries = response.data;
            });
    },
    methods: {
        onMouseEnterMapCountry (countryCode) {
            this.showMapOverlay = true
            // Update your data/property to be displayed on the overlay.
            this.countries.forEach((country) => {
                if (country.country_code === countryCode) {
                    this.totalCaseCount = country.country_total_confirmed;
                    this.countryName = country.country_name;
                }
            });
        },
        onMouseLeaveMapCountry () {
            this.showMapOverlay = false
        },
        onClickMapCountry (countryCode) {
            this.countries.forEach((country) => {
                if (country.country_code === countryCode) {
                    this.$router.push({name: 'edit', params: { id: country.id }});
                }
            });
        },
    }
});

</script>
