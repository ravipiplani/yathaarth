<?php

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

Route::post('/airlock/token', 'UserController@token');
Route::get('/login', function () {
   return response()->json([
      'message' => 'User not logged in.'
   ]);
})->name('login');

Route::group(['middleware' => 'auth:airlock'], function() {
    Route::get('/user', 'UserController@show');

    Route::get('/establishments', 'EstablishmentController@index');
    Route::post('/establishments', 'EstablishmentController@store');
    Route::get('/establishments/{establishment}', 'EstablishmentController@show');
    Route::delete('/establishments/{establishment}', 'EstablishmentController@delete');
    Route::get('/establishments/{establishment}/disable', 'EstablishmentController@disable');
    Route::get('/establishments/{establishment}/enable', 'EstablishmentController@enable');
    Route::patch('/establishments/{establishment}', 'EstablishmentController@update');
});

Route::fallback(function() {
    return response()->json([
        'message' => 'Invalid URL'
    ]);
});


