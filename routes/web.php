<?php

Route::get('/', function() {
    return redirect(app()->getLocale());
});

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['setlocale'],
], function() {


    // Handle multiple ways to get 'home'
    Route::get('/', function() {
        return view('home');
    })->name('home');

    Route::get('home', function() {
        return redirect()->route('home', app()->getLocale());
    });

    //default pages
    Route::get('about', function() {
        return view('about');
    });

    Route::get('start-sampling', function() {
        return view('start_sampling');
    });

    // QR Code Stuff
    Route::get('qr-codes', function() {
        return view('qr-codes');
    });

    Route::post('qr-newcodes', 'QrController@newCodes');
    Route::get('qr-print', 'QrController@printView');



    Route::get('downloads', 'DownloadsController@index');

    Route::post('home/login', 'HomeController@login');
    Route::post('home/admin', 'HomeController@checkAdmin');


    Route::group([
        'middleware' => ['auth'],
    ], function() {

        Route::get('create-project', 'CreateProjectController@index');
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
        Route::post('/projects/{id}/change-status', 'ProjectAccountController@changeStatus');
        Route::post('/projects/deleteForm', 'ProjectAccountController@deleteForm');

        Route::post('/projects/deleteMember', 'ProjectAccountController@deleteMember');

        Route::post('/kobo/publish', 'KoboController@publish');
        Route::post('/kobo/pull', 'KoboController@getProjectData');
        Route::post('/kobo/share', 'KoboController@share');

        Route::get('/projects/{id}/downloaddata', 'SubmissionController@download');

    });


    Auth::routes();

});

Route::get('/{any}', function($any){
    dd($any);
});


