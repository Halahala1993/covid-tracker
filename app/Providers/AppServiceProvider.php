<?php

namespace App\Providers;

use App\Http\Controllers\CovidMetadataController;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //TODO find a more reliable way to run this once a day (cron job) or on boot or both.
        $globalStats = (new CovidMetadataController())->retrieveMetadataById(1);
        if ($globalStats === null || ($globalStats != null && Carbon::now()->startOfDay()->gte($globalStats->date))) {
            (new CovidMetadataController())->retrieveMetadata();
        }
    }
}
