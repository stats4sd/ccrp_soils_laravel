<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('xlsform', 'XlsFormCrudController');

    Route::post('xlsform/{xlsform}/deploytokobo', 'XlsFormCrudController@deployToKobo');

    Route::crud('project', 'ProjectCrudController');
    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file