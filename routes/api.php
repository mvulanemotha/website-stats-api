<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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


// save ip address for a visitor
//Route::post('/savevisit' , 'ApiController@saveIP');
Route::post('/savevisit' , [ApiController::class , 'saveIP']);

Route::get('/today' , [ApiController::class , 'todayLogs']);

// get average of visitors for a day of the month
Route::get('/avday' , [ApiController::class , 'avday']);

//Monthly visists
Route::get('/monthly' , [ApiController::class , 'montlyVisits']);

// average montly visists
Route::get('/avmonthly' , [ApiController::class , 'avmonthly']);

// get average for a year
Route::get('/avyear' , [ApiController::class , 'avyear']);