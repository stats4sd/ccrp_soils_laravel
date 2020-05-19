<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Http\Requests\CrudRequest;

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
                'label' => 'User\'s Name'
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
        ]);
    }

    protected function setupCreateOperation()
    {
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
                'name' => 'password',
                'type' => 'password',
                'label' => 'Enter password for user',
            ],
            [
                'name' => 'password_confirmation',
                'type' => 'password',
                'label' => 'Confirm password for user',
            ],
            [
                'name' => 'slug',
                'type' => 'hidden',
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Store a newly created resource in the database.
     * @param StoreRequest $request - type injection used for validation using Requests
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->handlePasswordInput();
        $this->handleSlug();
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
        $this->handleSlug();
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

    protected function handleSlug ()
    {
       $crud_request = $this->crud->getRequest();

       if($crud_request->input('email')) {
            $slug = Str::slug($crud_request->input('email'));
            $crud_request->request->set('slug', $slug);

            $this->crud->setRequest($crud_request);
       }
    }


}
