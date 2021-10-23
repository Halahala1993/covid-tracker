/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import App from './App.vue';
import {routes} from "./routes";
import VueRouter from 'vue-router';
import axios from 'axios';
import MapsComponent from 'world-map-vue';
require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.prototype.axios = axios;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// import { MapsComponent, MapsPlugin } from '@syncfusion/ej2-vue-maps';

Vue.component('world-maps-component', MapsComponent)
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('country-component', require('./components/AllCountries.vue').default);
Vue.component('maps-component', require('./components/MapsComponent.vue').default);
Vue.component('global-stats-component', require('./components/GlobalStats.vue').default);
Vue.component('loader', require('./components/Loading.vue').default);

const router = new VueRouter({
    mode:'history',
    routes: routes
})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
    data: {
        isLoading: false,
        axiosInterceptor: null,
    },
    mounted() {
        this.enableInterceptor()
    },
    methods: {
        enableInterceptor() {
            this.axiosInterceptor = window.axios.interceptors.request.use((config) => {
                this.isLoading = true
                console.log('IS LOADING');
                return config
            }, (error) => {
                this.isLoading = false
                return Promise.reject(error)
            })

            window.axios.interceptors.response.use((response) => {
                this.isLoading = false
                console.log('IS NOT LOADING');
                return response
            }, function(error) {
                this.isLoading = false
                return Promise.reject(error)
            })
        },

        disableInterceptor() {
            window.axios.interceptors.request.eject(this.axiosInterceptor)
        },
    },
});

