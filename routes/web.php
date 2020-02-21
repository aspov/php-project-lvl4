<?php

use Rollbar\Rollbar;
use Rollbar\Payload\Level;

Rollbar::init(
    array(
        'access_token' => '45c4f29d2a0242e89b5b523d27d7d7af',
        'environment' => 'production'
    )
);
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


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('/users', 'UserController')->only([
    'index', 'show'
]);

Route::resource('/my/account', 'MyAccountController')->except([
    'create', 'store'
]);

#DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;")

