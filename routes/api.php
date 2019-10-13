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




//Route::post('domains','UserController@crateDomain');

//jwt routes
Route::resource('users','UserController');

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::resource('domains','DomainController');
});

Route::group(['middleware' => ['jwt.verify','domain.verify']], function() {
    Route::get('domains/{url}/auth','DomainController@domainAuth');
});

