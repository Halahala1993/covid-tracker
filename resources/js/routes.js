import AllCountries from "./components/AllCountries";
import EditCountry from "./components/EditCountry";
import MapsComponent from "./components/MapsComponent";
export const routes = [
    {
        name: 'home',
        path: '/',
        component: MapsComponent
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditCountry
    }
]
