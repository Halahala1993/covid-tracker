<template>
    <div>
        <h3 class="text-center">All Country Covid-19 Cases as of {{currentDate}}</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Country Name</th>
                <th>Country Code</th>
                <th>New Confirmed Cases</th>
                <th>Total Confirmed Cases</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="country in countries" :key="country.id">
                <td>{{ country.id }}</td>
                <td>{{ country.country_name }}</td>
                <td>{{ country.country_code }}</td>
                <td>{{ country.country_new_confirmed }}</td>
                <td>{{ country.country_total_confirmed }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: country.id }}" class="btn btn-primary">Edit
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
            countries: [],
            currentDate:String
        }
    },
    created() {

        var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
        this.currentDate = currentDateWithFormat.toString();
        console.log(currentDateWithFormat);

        this.axios
            .get('http://localhost:9000/api/country')
            .then(response => {
                this.countries = response.data;
            });
    },
    methods: {
        /*deleteCountry(id) {
            this.axios
                .delete(`http://localhost:9000/api/country/${id}`)
                .then(response => {
                    //Remove country from table
                    let i = this.countries.map(item => item.id).indexOf(id);
                    this.countries.splice(i, 1)
                });
        }*/
    }
}
</script>
