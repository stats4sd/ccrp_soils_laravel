<?php

Route::get('/', function() {
    return redirect(app()->getLocale());
});
Route::get('email', function() {
    return view('invite_member_email');
});
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['setlocale'],
], function() {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('/{key}/register','RegisterController@index');
    Route::get('/register', 'RegisterController@index');
    Route::post('/register/validator', 'RegisterController@validator');
    Route::post('/register/store', 'RegisterController@store');
    Route::get('/confirm-project/{project_id}/{user_id}/{key}', 'ConfirmProjectController@index');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');


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

    
        Route::post('/kobo/publish', 'KoboController@publish');
        Route::post('/kobo/pull', 'KoboController@getProjectData');
        Route::post('/kobo/share', 'KoboController@share');


    });


    // Auth::routes();

});



