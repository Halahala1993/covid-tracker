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

        Log:info('Amount of countries' . count($countries));
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
        $country->country_total_confirmed = $request->total_confirmed;
        $country->save();

        return response(null, Response::HTTP_OK);
    }
}
