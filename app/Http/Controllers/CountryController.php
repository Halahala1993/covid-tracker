<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{

    public function retrieveAllCountries()
    {
        $countries = DB::table('country')
            ->distinct()
            ->get();

        return response($countries,
            Response::HTTP_OK);
    }

    public function retrieveCountryDataById($id)
    {
        return Country::find($id);
    }

    public function updateCountryData(Request $request, $id)
    {
        $country = Country::find($id);
        $country->country_name = $request->country_name;
        $country->country_code = $request->country_code;
        $country->country_slug = $request->country_slug;
        $country->country_new_confirmed = $request->country_new_confirmed;
        $country->country_total_confirmed = $request->country_total_confirmed;
        $country->country_new_deaths = $request->country_new_deaths;
        $country->country_total_deaths = $request->country_total_deaths;
        $country->country_status_date = $request->country_status_date;
        $country->save();

        return response(null, Response::HTTP_OK);
    }
}
