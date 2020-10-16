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

Route::get('/', 'AuthController@home');
Route::post('/login', 'AuthController@login');

Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/logout', 'AuthController@logout');

	Route::middleware(['admin'])->group(function () {

	});
	Route::middleware(['siswa'])->group(function () {
		
	});
	Route::middleware(['sekolah'])->group(function () {
		
	});
});

Route::get('/test', 'AuthController@testing_auth');
Route::get('/wkwk', function () {
    return view('dashboard.index');
});
Route::get('/pelajaran', 'UserController@pelajaran');
Route::get('/admindt', 'UserController@admindt');
Route::get('/testing_db', 'UserController@testing_db');
