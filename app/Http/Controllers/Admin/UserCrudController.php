<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserStoreRequest as StoreRequest;
use App\Http\Requests\UserUpdateRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Str;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        CRUD::setModel('App\Models\User');
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */


    }

    protected function setupListOperation()
    {
        Crud::addColumns([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name'
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email Address',
            ],
            [
                'name' => 'admin',
                'type' => 'boolean',
                'label' => 'Is Admin?',
            ],
            [
                'name' => 'kobo_id',
                'type' => 'text',
                'label' => 'Kobotoolbox Username',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);

        Crud::addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Enter user\'s name',
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Enter user\'s email address',
            ],
            [
                'name' => 'kobo_id',
                'type' => 'text',
                'label' => 'Enter user\'s Kobotoolbox username',
            ],
            [
                'name' => 'admin',
                'type' => 'checkbox',
                'label' => 'Is this user an admin?',
                'hint' => 'Admin users have access to this backend dashboard and to data from all projects. Only RMS and Soils CCRP project members should have admin access.',
            ],
            [
                'name' => 'password',
                'type' => 'password',
                'label' => 'Enter password for user',
            ],
            [
                'name' => 'password_confirmation',
                'type' => 'password',
                'label' => 'Confirm password for user',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->setValidation(UpdateRequest::class);

    }

    /**
     * Store a newly created resource in the database.
     * @param StoreRequest $request - type injection used for validation using Requests
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->handlePasswordInput();
        return $this->traitStore($request);
    }

    /**
     * Update the specified resource in the database.
     * @param UpdateRequest $request - type injection used for validation using Requests
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $this->handlePasswordInput();
        return $this->traitUpdate($request);
    }

    /**
     * Handle password input fields.
     * Shamelessly copied from https://github.com/eduardoarandah/UserManager/blob/master/src/app/Http/Controllers/UserCrudController.php
     */
    protected function handlePasswordInput()
    {
        $crud_request = $this->crud->getRequest();

        // If a password was specified
        if ($crud_request->input('password')) {
            // encrypt it before storing it
            $hashed_password = bcrypt($crud_request->input('password'));

            $crud_request->request->set('password', $hashed_password);
            $crud_request->request->set('password_confirmation', $hashed_password);
        } else {
            // ignore the password inputs entirely
            $crud_request->request->remove('password');
            $crud_request->request->remove('password_confirmation');
        }

        $this->crud->setRequest($crud_request);
    }

}
