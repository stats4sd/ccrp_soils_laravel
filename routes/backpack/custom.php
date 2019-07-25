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
    CRUD::resource('form', 'FormCrudController');
    CRUD::resource('xlsform', 'XlsFormCrudController');
    CRUD::resource('activity', 'ActivityCrudController');
    CRUD::resource('activity_meta', 'Activity_metaCrudController');
    CRUD::resource('projectxlsform', 'ProjectxlsformCrudController');
    CRUD::resource('project', 'ProjectCrudController');
    CRUD::resource('projectMeta', 'ProjectMetaCrudController');
    CRUD::resource('projectMember', 'ProjectMemberCrudController');


    CRUD::resource('user', 'UserCrudController');
}); // this should be the absolute last line of this file