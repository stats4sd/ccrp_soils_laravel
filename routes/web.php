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

//Route::prefix('{locale?}')->middleware('set.locale')->group(function() {


Route::group([
  'prefix' => '{locale}',
  'where' => ['locale' => '[a-zA-Z]{2}'],
  'middleware' => 'set.locale'], function() {


    Route::get('/', function () {
        return redirect(app()->getLocale());
    });
    Route::get('/home', function(){
       return view('home');
   });

    Route::get('/', function(){

       return redirect('en/home');
   });

    Route::get('/admin', function(){
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
    Route::post('/home/login', 'HomeController@login');
    Route::post('/home/admin', 'HomeController@checkAdmin');
    

  Route::group([

      'middleware' => ['auth'],

  ], function () {

      Route::get('/{key}/register','RegisterController@index');
      Route::get('/register', 'RegisterController@index');
      Route::post('/register/validator', 'RegisterController@validator');
      Route::post('/register/store', 'RegisterController@store');
      Route::get('/confirm-project/{project_id}/{user_id}/{key}', 'ConfirmProjectController@index');

  	 Route::get('/create-project', 'CreateProjectController@index');
  	 Route::post('/create-project/validateValue', 'CreateProjectController@validateValue');


      // User profile
        Route::get('/projects/members/{username}', 'UserAccountController@index');
        Route::post('/projects/members/{id}/upload', 'UserAccountController@upload');
        Route::post('/projects/members/{id}/validateDetails', 'UserAccountController@validateDetails');
        Route::post('/projects/members/{id}/changePassword', 'UserAccountController@changePassword');
        Route::post('/projects/members/{id}/deleteProfile', 'UserAccountController@deleteProfile');
        Route::post('/projects/members/{id}/kobo-user', 'UserAccountController@koboUser');

        Route::get('/data-management', function () {
            return view('data_management');
        });

        Route::get('/create-project', 'CreateProjectController@index');
        Route::post('/create-project/validateValue', 'CreateProjectController@validateValue');

        Route::post('/create-project/upload', 'CreateProjectController@upload');
        Route::post('/create-project/store', 'CreateProjectController@store');
        Route::post('/create-project/send', 'CreateProjectController@sendEmail');

        Route::get('/projects', 'ProjectController@index');
        Route::get('/projects/{slug}', 'ProjectAccountController@index');
        Route::post('/projects/{id}/validateGroup', 'ProjectAccountController@validateGroup');
        Route::post('/projects/{id}/upload', 'ProjectAccountController@upload');
        Route::post('/projects/{id}/send', 'ProjectAccountController@sendEmail');


        Route::post('/projects/{id}/delete', 'ProjectAccountController@delete');
        Route::post('/projects/changeStatus', 'ProjectAccountController@changeStatus');
        Route::post('/projects/deleteForm', 'ProjectAccountController@deleteForm');
        
        Route::post('/projects/deleteMember', 'ProjectAccountController@deleteMember');

      	Route::post('/kobo/publish', 'KoboController@publish');
        Route::post('/kobo/pull', 'KoboController@getProjectData');
        Route::post('/kobo/share', 'KoboController@share');

        Route::get('/projects/{id}/downloaddata', 'SubmissionController@download');






  });



});


Auth::routes();

