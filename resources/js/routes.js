import AllCountries from "./components/AllCountries";
import EditCountry from "./components/EditCountry";
import MapsComponent from "./components/MapsComponent";
import Home from "./components/Home";
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditCountry
    }
]
