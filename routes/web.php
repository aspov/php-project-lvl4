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


Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::resource('/users', 'UserController')->only(['index', 'show']);
Route::resource('/my/account', 'MyAccountController')->except(['create', 'store']);
Route::resource('/tasks/task_statuses', 'TaskStatusController')->except(['show']);
Route::resource('/tasks', 'TaskController');
Route::resource('/tasks.tags', 'TaskTagController')->only(['store', 'destroy']);
