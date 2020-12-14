<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectStoreRequest as StoreRequest;
use App\Http\Requests\ProjectUpdateRequest as UpdateRequest;
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
            [
                'name' => 'identifiers',
                'label' => 'Custom Identifiers',
                'type' => 'multidimensional_array',
                'visible_key' => 'label',
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
                'entity' => 'creator',
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
                'type' => 'image',
            ],
            [
                'name' => 'share_data',
                'label' => 'Does this project consent to share aggregated / anonymised data?',
                'type' => 'boolean',
            ],
            [
                'name' => 'identifiers',
                'label' => 'enter any custom identifiers that the project uses in the sample collection form',
                'type' => 'repeatable',
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => 'Variable Name',
                        'type' => 'text',
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ],
                    [
                        'name' => 'label',
                        'label' => 'Label',
                        'type' => 'text',
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ],
                ],
            ],
            [
                'name' => 'highR',
                'label' => 'Does this project need P Analysis outputs split between LR and HR?',
                'type' => 'boolean',
            ],
            [
                'name' => 'customR',
                'label' => 'Does this project need extra P Analysis outputs for Custom Reagents?',
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
