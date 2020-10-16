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
    return view('dashboard.index');
});
Route::get('/testing', function () {
    return view('dashboard.testing');
});
Route::get('/pelajaran', 'UserController@pelajaran');
Route::get('/admindt', 'UserController@admindt');
Route::get('/testing_db', 'UserController@testing_db');
