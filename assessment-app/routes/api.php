<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/npi_query', function(Request $request) {
    $data = $request->json()->all();

    $uri_values = [
        'first_name=' . urlencode($data['first_name']),
        'last_name=' . urlencode($data['last_name']),
        'npi_number=' . urlencode($data['npi_number']),
        'taxonomy_description='. urlencode($data['taxonomy_description']),
        'city=' . urlencode($data['city']),
        'state=' . urlencode($data['state']),
        'zip_code=' . urlencode($data['zip_code']),
        'version=2.1',
        'limit=2',
        'skip=0',
    ];

    $query_url = 'https://npiregistry.cms.hhs.gov/api/?' . join('&', $uri_values);
    $query_response = Http::get($query_url)->json();

    return response()->json([
        'result_count'         => $query_response['result_count'],
        'results'              => $query_response['results'],
    ], 200);
});

