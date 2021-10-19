<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CovidMetadataController extends Controller
{

    /**
     * Retrieve covid 19 tracking metadata from URL in .env file
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function retrieveMetadata()
    {

        $response = Http::get($this->domain =env('COVID_TRACKER_URL'));
        if ($response != null && json_decode($response)->Global != null)
        {
            $this->cleanMetadata();
        } else {
            //TODO Throw error statement
        }
        $listOfCountries = json_decode($response)->Countries;
        $this->saveCountryData($listOfCountries);


        return response($response,Response::HTTP_OK);
    }

    /**
     * Persist all the country data
     *
     * @param $listOfCountries
     */
    private function saveCountryData($listOfCountries)
    {
        //TODO third party API doesn't have greenland for some reason :(
        if ($listOfCountries != null && count($listOfCountries) > 0) {

            //Clean country data to avoid unnecessary duplicates and only keep the latest data
            $this->cleanCountryData();

            foreach ($listOfCountries as $country) {
                $newCountry = new Country();
                $newCountry->country_name = $country->Country;
                $newCountry->country_code = $country->CountryCode;
                $newCountry->country_slug = $country->Slug;
                $newCountry->country_new_confirmed = $country->NewConfirmed;
                $newCountry->country_total_confirmed = $country->TotalConfirmed;
                $newCountry->country_new_deaths = $country->NewDeaths;
                $newCountry->country_total_deaths = $country->TotalDeaths;
                $newCountry->country_status_date = Carbon::parse($country->Date);
                $newCountry->save();
            }
        }

    }

    /**
     * Clean the present country data to only keep the latest data
     */
    private function cleanCountryData()
    {
        DB::table('country')->delete();
    }

    /**
     * Clean the present metadata to only keep the latest data
     */
    private function cleanMetadata()
    {
        DB::table('covid_metadata')->delete();
    }
}
