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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', function () {
    return view('home');
});

Route::get('/home/about', function () {
    return view('about');
});

Route::get('/start-sampling', function () {
    return view('start_sampling');
});

Route::get('/data-management', function () {
	return view('data_management');
});

Route::get('/qr-codes', function() {
	return view('qr_code');
});

Route::get('/downloads', function() {
	return view('downloads');
});

