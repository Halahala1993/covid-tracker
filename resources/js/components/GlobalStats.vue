<template>
    <div>
        <h3 class="text-center">All Country Covid-19 Cases as of {{ currentDate }}</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Countries With Known Cases</th>
                <th>New Global Confirmed Cases</th>
                <th>Total Global Confirmed Cases</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ this.countryCount }}</td>
                <td>{{ this.newGlobalCaseCount}}</td>
                <td>{{ this.totalGlobalCaseCount }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentDate: String,
            searchQuery: null,
            countryCount: 0,
            newGlobalCaseCount: 0,
            totalGlobalCaseCount: 0
        }
    },
    props: ['countries']
    ,
    watch: {
        $props: {
            handler() {
                this.$props.countries.forEach((country) => {
                    if (country.total_confirmed > 0) {
                        this.countryCount++;
                        this.totalGlobalCaseCount += country.total_confirmed;
                        if (country.new_confirmed > 0) {
                            this.newGlobalCaseCount += country.new_confirmed;
                        }
                    }
                });
            },
            deep: true,
            immediate: true,
        },
    },
    computed: {
    },
    created() {

        let currentDateWithFormat = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
        this.currentDate = currentDateWithFormat.toString();
        // console.log(currentDateWithFormat);
    },
    methods: {
        /*deleteCountry(id) {
            this.axios
                .delete(`${this.baseUrl}/country/${id}`)
                .then(response => {
                    //Remove country from table
                    let i = this.countries.map(item => item.id).indexOf(id);
                    this.countries.splice(i, 1)
                });
        }*/
    }
}
</script>
