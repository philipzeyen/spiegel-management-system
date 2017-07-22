<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::guest())
        return view('auth.login');
    else
        return redirect('/home');
});

Auth::routes();

Route::get('/home', 'SteleController@index');

/*** Anfang Stelen ***/
Route::get('/stele', 'SteleController@index');

Route::get('stele/create', 'SteleController@showCreateForm');
Route::post('stele/create', 'SteleController@createStele');

Route::get('stele/edit/{stele}', 'SteleController@showEditForm');
Route::post('stele/edit/{stele}', 'SteleController@updateStele');

Route::get('stele/delete/{stele}', 'SteleController@delete');
/*** Ende Stelen ***/

/*** Anfang Config ***/
Route::get('config', 'ConfigController@index');

Route::get('config/create', 'ConfigController@showCreateForm');
Route::post('config/create', 'ConfigController@createConfig');

Route::get('config/edit/{config}', 'ConfigController@showEditForm');
Route::post('config/edit/{config}', 'ConfigController@updateConfig');

Route::get('config/delete/{config}', 'ConfigController@delete');
/*** Ende Config ***/

/*** Anfang Masken ***/
Route::get('maske', 'MaskeController@index');

Route::get('maske/create', 'MaskeController@showCreateForm');
Route::post('maske/create', 'MaskeController@createMaske');

Route::get('maske/edit/{maske}', 'MaskeController@showEditForm');
Route::post('maske/edit/{maske}', 'MaskeController@updateMaske');

Route::get('maske/delete/{maske}', 'MaskeController@delete');
/*** Ende Masken ***/

/*** Anfang User ***/
Route::get('user', 'UserController@index');

Route::get('user/create', 'UserController@showCreateForm');
Route::post('user/create', 'UserController@createUser');

Route::get('user/edit/{user}', 'UserController@showEditForm');
Route::post('user/edit/{user}', 'UserController@updateUser');

Route::get('user/delete/{user}', 'UserController@delete');

//Route::get('user/profile/{user}', 'UserController@showProfile');
/*** Ende User ***/