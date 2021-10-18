import AllCountries from "./components/AllCountries";
import EditCountry from "./components/EditCountry";
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllCountries
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditCountry
    }
]
