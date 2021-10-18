<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CovidMetadataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/metadata', [CovidMetadataController::class, 'retrieveMetadata']);
Route::get('/country', [CountryController::class, 'retrieveAllCountries']);
Route::get('/country/{id}', [CountryController::class, 'retrieveCountryDataById']);
Route::put('/country/{id}', [CountryController::class, 'updateCountryData']);
