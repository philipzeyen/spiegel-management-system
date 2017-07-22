<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('stele/register/{id}', 'ApiController@registerStele')->name('registerStele');

Route::group(['prefix' => '{stele}'], function() {
    Route::get('heartbeat', 'ApiController@heartbeat')->name('heartbeat');

    Route::group(['prefix' => 'config'], function() {
        Route::get('/', 'ApiController@getConfig')->name('getConfig');
        Route::get('punkte/{name_maske}' , 'ApiController@getConfigPunkte')->name('getConfigPunkte');
        Route::get('textur/{name_maske}' , 'ApiController@getConfigTextur')->name('getConfigTextur');
    });
});
