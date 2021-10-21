<template>
    <div>
        <h3 class="text-center">All Country Covid-19 Cases as of {{ currentDate }}</h3><br/>

        <div class="row">
            <div class="search-wrapper panel-heading col-sm-4">
                <input class="form-control" type="text" v-model="searchQuery" placeholder="Search"/>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
<!--                <th>ID</th>-->
                <th>Country Name</th>
                <th>Country Code</th>
                <th>New Confirmed Cases</th>
                <th>Total Confirmed Cases</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="country in resultQuery" :key="country.id">
<!--                <td>{{ country.id }}</td>-->
                <td>{{ country.name }}</td>
                <td>{{ country.code }}</td>
                <td>{{ country.new_confirmed }}</td>
                <td>{{ country.total_confirmed }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: country.id }}" class="btn btn-primary">
                            Edit
                        </router-link>
                        <!--                        <button class="btn btn-danger" @click="deleteCountry(country.id)">Delete</button>-->
                    </div>
                </td>
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
        }
    },
    props: ['countries']
    ,
    watch: {
        $props: {
            handler() {

            },
            deep: true,
            immediate: true,
        },
    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                return this.$props.countries.filter((country) => {
                    return this.searchQuery
                        .toLowerCase()
                        .split(' ')
                        .every(v => country.name.toLowerCase().includes(v))
                })
            } else {
                return this.$props.countries;
            }
        }
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
