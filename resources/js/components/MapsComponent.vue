<template>
    <div class="wrapper">
        <world-maps-component
            :country-data="countryData"
            :show-overlay="showMapOverlay"
            :countryColors="false"
            :lowColor="'blue'"
            :highColor="'red'"
            :showColorBar="true"
            @mouseenter="onMouseEnterMapCountry"
            @mouseleave="onMouseLeaveMapCountry"
            @click="onClickMapCountry"
        >
            <template v-slot:overlay>
                <p v-if="totalCaseCount === 0">No case information available for {{countryName}}</p>
                <p v-if="totalCaseCount > 0">{{countryName}}'s Total Case Count: {{totalCaseCount}}</p>
            </template>
        </world-maps-component>
    </div>
</template>
<script>
export default {
    props: {
        countries: []
    },
    watch: {
        countries () {
            this.calculateCountryColorCode();
        }
    },
    data() {
        return {
            countryData: {
                US: 100,
                CA: 200,
                GB: 500,
            },
            totalCaseCount: 0,
            countryName: '',
            showMapOverlay: false
        };
    },
    methods: {

        //TODO implement tooltip under mouse instead of built in overlay
        onMouseEnterMapCountry (countryCode) {
            this.showMapOverlay = true
            let unlistedCountry = true;
            this.$props.countries.forEach((country) => {
                if (country.country_code === countryCode) {
                    this.totalCaseCount = country.country_total_confirmed;
                    this.countryName = country.country_name;
                    unlistedCountry = false;
                }
            });

            //Information mismatch between 3rd party API and maps info.
            //TODO Implement a seed for all countries and sync it all up
            if (unlistedCountry === true) {
                this.countryName = countryCode;
                this.totalCaseCount = 0;
            }
        },
        onMouseLeaveMapCountry () {
            this.showMapOverlay = false
        },
        onClickMapCountry (countryCode) {
            this.$props.countries.forEach((country) => {
                if (country.country_code === countryCode) {
                    this.$router.push({name: 'edit', params: { id: country.id }});
                }
            });
        },
        /*
        * Apply the color code values depending on the amount of digits in total cases
        * for a given country.
        */
        calculateCountryColorCode()  {
            this.countryData = {};
            this.$props.countries.forEach((country) => {
                let totalConfirmedLength = country.country_total_confirmed.toString().length;
                this.countryData[country.country_code] =  totalConfirmedLength * 20;
            });
        }
    }
}

</script>
