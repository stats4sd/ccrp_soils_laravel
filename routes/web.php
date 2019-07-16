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

Route::prefix('{locale?}')->middleware('set.locale')->group(function() {
	

Route::get('/about', function () {
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

Route::get('/register', function() {
	return view('register');
});



Route::get('/home', 'HomeController@index');

##Login and logout
Route::post('/home/checklogin', 'HomeController@checklogin');
Route::get('/home/successlogin', 'HomeController@successlogin');
Route::get('/home/logout', 'HomeController@logout');
Route::get('/downloads', 'DownloadsController@index');

// Route::get('/', 'HomeController@index');

Route::get('/create-project', 'CreateProjectController@index');
Route::post('/create-project/validateValue', 'CreateProjectController@validateValue');


Route::post('/create-project/upload', 'CreateProjectController@upload');
Route::post('/create-project/store', 'CreateProjectController@store');
Route::post('/create-project/send', 'CreateProjectController@sendEmail');



Route::get('/projects', 'ProjectController@index');

});


Auth::routes();

