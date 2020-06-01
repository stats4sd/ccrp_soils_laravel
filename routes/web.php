<?php

Route::group([
    'middleware' => 'locale',
], function() {

    Auth::routes();

    // //Override the regsiter route to include optional invite
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

    Route::view('/', 'home')->middleware('guest')->name('home');

    Route::view('about', 'about')->name('about');
    Route::view('qr-codes', 'qr_code')->name('qr-codes');
    Route::view('contact', 'contact')->name('contact');


    Route::post('qr-newcodes', 'QrController@newCodes')->name('qr-newcodes');
    Route::get('qr-print', 'QrController@printView')->name('qr-print');

    Route::get('downloads', 'DownloadsController@index')->name('downloads');

    Route::group([
        'middleware' => ['auth'],
    ], function() {


        Route::resources([
            'users' => 'UserController',
            'projects' => 'ProjectController',
        ]);

        Route::get('projects/{project}#{tab?}', 'ProjectController@show')->name('projects.show');

        // Modified Resource Controller for ProjectMember
        Route::get('projects/{project}/projectmembers/create', 'ProjectMemberController@create')->name('projectmembers.create');
        Route::post('projects/{project}/projectmembers', 'ProjectMemberController@store')->name('projectmembers.store');
        //show and index methods not required (yet)
        Route::get('projects/{project}/projectmembers/{user}/edit', 'ProjectMemberController@edit')->name('projectmembers.edit');
        Route::put('projects/{project}/projectmembers/{user}', 'ProjectMemberController@update')->name('projectmembers.update');
        Route::delete('projects/{project}/projectmembers/{user}', 'ProjectMemberController@destroy')->name('projectmembers.destroy');

        Route::get('my-account', 'UserController@account')->name('users.account');
        Route::get('users/{user}/password', 'UserController@editPassword')->name('users.password.edit');
        Route::put('users/{user}/password', 'UserController@updatePassword')->name('users.password.update');

        //User
        // Route::post('/users/{id}/upload', 'UserController@upload');
        // Route::post('/users/{id}/validateDetails', 'UserController@validateDetails');
        // Route::post('/users/{id}/changePassword', 'UserController@changePassword');
        // Route::post('/users/{id}/deleteProfile', 'UserController@deleteProfile');
        // Route::post('/users/{id}/kobo-user', 'UserController@koboUser');

        //Projects
        Route::post('/projects/changeStatus', 'ProjectController@changeStatusUser');
        Route::post('/projects/deleteMember', 'ProjectController@deleteMember');
        Route::post('/projects/{id}/validateGroup', 'ProjectController@validateGroup');
        Route::post('/projects/{id}/send', 'ProjectController@sendEmail');
        Route::get('/projects/{id}/download-samples-merged', 'ProjectController@download');
        Route::get('/projects/{id}/downloaddata', 'SubmissionController@download');


        // Route::get('/projects/{project}/form/{form}/publish', 'KoboController@publish')->name("kobo.publish");
        // Route::get('/projects/{project}/form/{form}/pull', 'KoboController@getProjectData')->name("kobo.pull");
        // Route::post('/projects/{project}/form/{form}/share/{user}', 'KoboController@share')->name("kobo.share");

    });

});

