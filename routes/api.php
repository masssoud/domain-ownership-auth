<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {

    $user = \Illuminate\Support\Facades\Auth::user();

    dd($user,'sa');
    return $request->user();
});


Route::resource('users','UserController');


//Route::post('domains','UserController@crateDomain');

//jwt routes

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::resource('domains','DomainController');
    Route::post('domains/{domain}/auth','DomainController@domainAuth');
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
});

