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



Route::get('/home', function(){
	return redirect('home');
});

Route::get('/', function(){
	return view('home');
});
Route::get('/admin/login', function(){
	return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/start-sampling', function () {
    return view('start_sampling');
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
Route::get('/downloads', 'DownloadsController@index');

Route::get('/projects', 'ProjectController@index');

Route::post('/register/validator', 'RegisterController@validator');
Route::post('/register/store', 'RegisterController@store');


Route::group([

    'middleware' => ['auth'],

], function () {

	Route::get('/projects/members/{username}', 'UserAccountController@index');

	Route::get('/data-management', function () {
		return view('data_management');
	});

	Route::get('/create-project', 'CreateProjectController@index');
	Route::post('/create-project/validateValue', 'CreateProjectController@validateValue');

	Route::post('/create-project/upload', 'CreateProjectController@upload');
	Route::post('/create-project/store', 'CreateProjectController@store');
	Route::post('/create-project/send', 'CreateProjectController@sendEmail');

	Route::get('/projects/{slug}', 'ProjectAccountController@index');
	Route::post('/projects/{id}/validateGroup', 'ProjectAccountController@validateGroup');
	Route::post('/projects/{id}/upload', 'ProjectAccountController@upload');
	Route::post('/projects/{id}/send', 'ProjectAccountController@sendEmail');

	Route::post('/kobo/publish', 'KoboController@publish');

});







});


Auth::routes();

