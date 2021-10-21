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

    public function retrieveCountryById($id)
    {
        return Country::find($id);
    }

    public function retrieveCountryByCountryCode($countryCode)
    {
        return Country::where('code', $countryCode)->first();
    }

    public function updateCountryData(Request $request, $id)
    {
        $country = Country::find($id);
        $country->name = $request->name;
        $country->code = $request->code;
        $country->slug = $request->slug;
        $country->new_confirmed = $request->new_confirmed;
        $country->total_confirmed = $request->total_confirmed;
        $country->new_deaths = $request->new_deaths;
        $country->total_deaths = $request->total_deaths;
        $country->status_date = $request->status_date;
        $country->save();

        return response(null, Response::HTTP_OK);
    }
}
