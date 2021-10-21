<template>
    <div class="wrapper">
        <world-maps-component
            :country-data="countryData"
            :show-overlay="showMapOverlay"
            :countryColors="false"
            :lowColor="'blue'"
            :highColor="'red'"
            :showColorBar="true"
            :countryStrokeColor="'black'"
            @mouseenter="onMouseEnterMapCountry"
            @mouseleave="onMouseLeaveMapCountry"
            @click="onClickMapCountry"
        >
            <template v-slot:overlay>
                    <div class="card-body">
                        <h5 class="card-title">{{countryName}}</h5>
                        <p v-if="totalCaseCount === 0" class="card-text">No case information available for {{countryName}}</p>
                        <table v-if="totalCaseCount > 0" class="table-bordered">
                            <thead>
                            <tr>
                                <th scope="col"> New Covid Cases </th>
                                <th scope="col"> Total Covid Cases </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{newCaseCount}}</td>
                                <td>{{totalCaseCount}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </template>
        </world-maps-component>
    </div>
</template>
<script>
export default {
    data() {
        return {
            countryData: {
                US: 100,
                CA: 200,
                GB: 500,
            },
            totalCaseCount: 0,
            newCaseCount:0,
            countryName: '',
            showMapOverlay: false
        };
    },
    props: ['countries']
    ,
    watch: {
        $props: {
            handler() {
                this.calculateCountryColorCode();
            },
            deep: true,
            immediate: true,
        },
    },
    methods: {

        //TODO implement tooltip under mouse instead of built in overlay
        onMouseEnterMapCountry (countryCode) {
            if (this.$props.countries != null && this.$props.countries.length > 0) {
                this.populateOverlayInformation(countryCode);
            }
        },
        onMouseLeaveMapCountry () {
            this.showMapOverlay = false
        },
        onClickMapCountry (countryCode) {
            if (this.$props.countries != null && this.$props.countries.length > 0) {

                this.$props.countries.forEach((country) => {
                    if (country.code === countryCode) {
                        this.$router.push({name: 'edit', params: {id: country.id}});
                    }
                });
            }
        },
        /*
        * Apply the color code values depending on the amount of digits in total cases
        * for a given country.
        */
        calculateCountryColorCode()  {
            this.countryData = {};
            this.$props.countries.forEach((country) => {
                let totalConfirmedLength = country.total_confirmed.toString().length;
                //Unknown case amount should be white
                if (country.total_confirmed > 0) {
                    this.countryData[country.code] = totalConfirmedLength * 20;
                }
            });
        },
        /*
        * Generate information to display in map overlay on hover
        */
        populateOverlayInformation(countryCode) {
            this.showMapOverlay = true
            let unlistedCountry = true;
            this.$props.countries.forEach((country) => {
                if (country.code === countryCode) {
                    this.totalCaseCount = country.total_confirmed;
                    this.newCaseCount = country.new_confirmed;
                    this.countryName = country.name;
                    unlistedCountry = false;
                }
            });

            //In case of information mismatch between 3rd party API and maps info.
            if (unlistedCountry === true) {
                this.countryName = countryCode;
                this.totalCaseCount = 0;
            }
        }
    }
}

</script>
