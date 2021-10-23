<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\GlobalStats;
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
            //TODO Throw error statement
        }


        $globalStats = $this->saveGlobalStats(json_decode($response)->Global);
        $listOfCountries = json_decode($response)->Countries;
        $this->saveCountryData($listOfCountries);


        return response($globalStats,Response::HTTP_OK);
    }

    public function retrieveMetadataById($id)
    {
        return GlobalStats::find($id);
    }

    /**
     * Persist all the country data
     *
     * @param $listOfCountries
     */
    private function saveCountryData($listOfCountries)
    {

        if ($listOfCountries != null && count($listOfCountries) > 0) {

            //Clean country data to avoid unnecessary duplicates and only keep the latest data
            //$this->cleanCountryData();

            foreach ($listOfCountries as $country) {
                $theCountry = (new CountryController)->retrieveCountryByCountryCode($country->CountryCode);
                if ($theCountry === null ) {
                    info("failed code: " . $country->CountryCode);
                    continue;
                }

                //$theCountry->name = $country->Country;
                $theCountry->code = $country->CountryCode;
                $theCountry->slug = $country->Slug;
                $theCountry->new_confirmed = $country->NewConfirmed;
                $theCountry->total_confirmed = $country->TotalConfirmed;
                $theCountry->new_deaths = $country->NewDeaths;
                $theCountry->total_deaths = $country->TotalDeaths;
                $theCountry->status_date = Carbon::parse($country->Date);
                //info('Country:' . $theCountry->name);
                $theCountry->save();
            }
        }
    }

    private function saveGlobalStats($metadata): GlobalStats
    {
        $globalStats = $this->retrieveMetadataById(1);//Just keep one row for simplicity
        if ($globalStats === null) {
            $globalStats = new GlobalStats();
        }
        $globalStats->new_confirmed = $metadata->NewConfirmed;
        $globalStats->total_confirmed = $metadata->TotalConfirmed;
        $globalStats->new_deaths = $metadata->NewDeaths;
        $globalStats->total_deaths = $metadata->TotalDeaths;
        $globalStats->date = Carbon::parse($metadata->Date);
        $globalStats->save();

        return $globalStats;
    }
}
