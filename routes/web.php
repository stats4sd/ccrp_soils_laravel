<?php

Auth::routes();

Route::get('/confirm-project/{project_id}/{user_id}/{key}', 'ConfirmProjectController@index');

// Handle multiple ways to get 'home'
Route::get('/', function() {
    return view('home');
})->name('home');

//default pages
Route::get('about', function() {
    return view('about');
})->name('about');

Route::get('start-sampling', function() {
    return view('start_sampling');
});

// QR Code Stuff
Route::get('qr-codes', function() {
    return view('qr_code');
});

Route::post('qr-newcodes', 'QrController@newCodes');
Route::get('qr-print', 'QrController@printView');



Route::get('downloads', 'DownloadsController@index');

Route::post('home/login', 'HomeController@login');
Route::post('home/admin', 'HomeController@checkAdmin');


Route::group([
    'middleware' => ['auth'],
], function() {
    //Create Project
    Route::get('create-project', 'CreateProjectController@index');
    Route::post('/create-project/validateValue', 'CreateProjectController@validateValue');
    Route::post('/create-project/upload', 'CreateProjectController@upload');
    Route::post('/create-project/store', 'CreateProjectController@store');
    Route::post('/create-project/send', 'CreateProjectController@sendEmail');

    Route::resources([
        'users' => 'UserController',
        'projects' => 'ProjectController'
    ]);

    //User
    Route::post('/users/{id}/upload', 'UserController@upload');
    Route::post('/users/{id}/validateDetails', 'UserController@validateDetails');
    Route::post('/users/{id}/changePassword', 'UserController@changePassword');
    Route::post('/users/{id}/deleteProfile', 'UserController@deleteProfile');
    Route::post('/users/{id}/kobo-user', 'UserController@koboUser');

    //Projects
    Route::get('/projects', 'ProjectController@index');
    Route::post('/projects/{id}/uploadImage', 'ProjectController@uploadImage');
    Route::post('/projects/changeStatus', 'ProjectController@changeStatusUser');
    Route::post('/projects/deleteMember', 'ProjectController@deleteMember');
    Route::post('/projects/{id}/destroy', 'ProjectController@destroy');
    Route::post('/projects/{id}/validateGroup', 'ProjectController@validateGroup');
    Route::post('/projects/{id}/send', 'ProjectController@sendEmail');
    Route::get('/projects/{id}/download-samples-merged', 'ProjectController@download');
    Route::get('/projects/{id}/downloaddata', 'SubmissionController@download');


    Route::get('/projects/{project}/form/{form}/publish', 'KoboController@publish')->name("kobo.publish");
    Route::get('/projects/{project}/form/{form}/pull', 'KoboController@getProjectData')->name("kobo.pull");
    Route::post('/projects/{project}/form/{form}/share/{user}', 'KoboController@share')->name("kobo.share");

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
