<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest as StoreRequest;
use App\Http\Requests\ProjectRequest as UpdateRequest;
use App\Models\User;
use Backpack\CRUD\CrudPanel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        CRUD::setModel('App\Models\Project');
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings('project', 'projects');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

    }

    protected function setupListOperation()
    {
        $this->crud->setColumns([
            [
                'name' => 'creator',
                'label' => 'Creator',
                'type' => 'select',
                'entity' => 'users',
                'attribute' => 'name',
                'model' => User::class,
            ],
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'text',
                'limit' => 20
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);


        $this->crud->addFields([
            [
                'name' => 'creator_id',
                'label' => 'Creator of the Project',
                'type' => 'select2',
                'entity' => 'users',
                'attribute' => 'name',
                'model' => User::class,
            ],
            [
                'name' => 'name',
                'label' => 'Name of the Project',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'textarea',
            ],
            [
                'name' => 'avatar',
                'label' => 'Project Image',
                'type' => 'upload',
            ],
            [
                'name' => 'share_data',
                'label' => 'Does this project consent to share aggregated / anonymised data?',
                'type' => 'boolean',
            ],
        ]);
    }



    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->setValidation(UpdateRequest::class);

    }
}
