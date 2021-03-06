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
    Route::crud('xlsform', 'XlsformCrudController');

    Route::post('xlsform/{xlsform}/deploytokobo', 'XlsformCrudController@deployToKobo');
    Route::post('xlsform/{xlsform}/syncdata', 'XlsformCrudController@syncData');
    Route::post('xlsform/{xlsform}/archive', 'XlsformCrudController@archiveOnKobo');


    Route::crud('project', 'ProjectCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('datamap', 'DataMapCrudController');
    Route::crud('sample', 'SampleCrudController');
    Route::crud('projectsubmission', 'ProjectSubmissionCrudController');
    Route::crud('nutrientbalance', 'NutrientBalanceCrudController');
    Route::crud('farmerfield', 'FarmerFieldCrudController');


}); // this should be the absolute last line of this file
