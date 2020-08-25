<?php

use App\Http\Controllers\LanguageController;
use App\Jobs\UploadMediaFileAttachementsToKoboForm;
use App\Models\Xlsform;

Route::post('contact', 'ContactController@store')->name('contact.store');
Route::post('langage', 'LanguageController@changeLanguage')->name('language');

Route::get('testingmediaupload', function () {
    $form = Xlsform::find(14);
    UploadMediaFileAttachementsToKoboForm::dispatchNow($form);
});

/**
 * Routes for making requests that require Authentication, but should not be translated
 */
Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('projects/{project}/projectxlsforms', 'ProjectXlsformController@index')->name('projectxlsforms.get');
    Route::post('projectxlsforms/{project_xlsform}/deploytokobo', 'ProjectXlsformController@deployToKobo')->name('projectxlsforms.deploy');
    Route::post('projectxlsforms/{project_xlsform}/syncdata', 'ProjectXlsformController@syncData')->name('projectxlsforms.sync');
    Route::post('projectxlsforms/{project_xlsform}/getdata', 'ProjectXlsformController@getData')->name('projectxlsforms.getdata');
    Route::post('projectxlsforms/{project_xlsform}/download', 'ProjectXlsformController@download')->name('projectxlsforms.download');
});

/**
 * Routes that should involve translation (and redirect to en/ fr/ es/ etc )
 */
Route::group([
    'middleware' => 'locale',
], function () {
    Auth::routes();

    // //Override the regsiter route to include optional invite
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

    Route::view('/', 'home')->middleware('guest')->name('home');
    Route::get('home', function () {
        return redirect('/');
    });

    Route::view('about', 'about')->name('about');
    Route::view('qr-codes', 'qr_code')->name('qr-codes');
    Route::view('contact', 'contact')->name('contact');

    Route::post('qr-newcodes', 'QrController@newCodes')->name('qr-newcodes');
    Route::get('qr-print', 'QrController@printView')->name('qr-print');

    Route::get('downloads', 'DownloadsController@index')->name('downloads');



    Route::group([
        'middleware' => ['auth'],
    ], function () {
        Route::resources([
            'users' => 'UserController',
            'projects' => 'ProjectController',
        ]);

        Route::get('projects/{project}#{tab?}', 'ProjectController@show')->name('projects.show');
        Route::get('projects/{project}/downloadsamples', 'SampleMergedController@download')->name('projects.downloadsamples');

        // // Modified Resource Controller for ProjectMember
        Route::get('projects/{project}/projectmembers/create', 'ProjectMemberController@create')->name('projectmembers.create');
        Route::post('projects/{project}/projectmembers', 'ProjectMemberController@store')->name('projectmembers.store');
        //show and index methods not required (yet)
        Route::get('projects/{project}/projectmembers/{user}/edit', 'ProjectMemberController@edit')->name('projectmembers.edit');
        Route::put('projects/{project}/projectmembers/{user}', 'ProjectMemberController@update')->name('projectmembers.update');
        Route::delete('projects/{project}/projectmembers/{user}', 'ProjectMemberController@destroy')->name('projectmembers.destroy');


        Route::get('my-account', 'UserController@account')->name('users.account');
        Route::get('users/{user}/password', 'UserController@editPassword')->name('users.password.edit');
        Route::put('users/{user}/password', 'UserController@updatePassword')->name('users.password.update');


        Route::get('xlsforms/{xlsform}/downloadsubmissions', 'SubmissionController@download')->name('xlsforms.downloadsubmissions');
        Route::post('admin/xlsform/{xlsform}/updaterecords', 'DataMapController@updateAllRecords')->name('xlsforms.updaterecords');

        // //User
        // Route::post('/users/{id}/upload', 'UserController@upload');
        // Route::post('/users/{id}/validateDetails', 'UserController@validateDetails');
        // Route::post('/users/{id}/changePassword', 'UserController@changePassword');
        // Route::post('/users/{id}/deleteProfile', 'UserController@deleteProfile');
        // Route::post('/users/{id}/kobo-user', 'UserController@koboUser');
    });
});
