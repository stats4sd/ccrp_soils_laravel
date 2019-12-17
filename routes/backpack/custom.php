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
    Route::crud('activity', 'ActivityCrudController');
    Route::crud('activity_meta', 'Activity_metaCrudController');
    Route::crud('projectxlsform', 'ProjectxlsformCrudController');
    Route::crud('project', 'ProjectCrudController');
    Route::crud('projectMeta', 'ProjectMetaCrudController');
    Route::crud('projectMember', 'ProjectMemberCrudController');

    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file