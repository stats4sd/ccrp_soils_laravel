<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest as StoreRequest;
use App\Http\Requests\ProjectRequest as UpdateRequest;
use App\User;
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
    #use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
                'name' => 'status',
                'label' => 'Status',
                'type' => 'text',
            ],
            [
                'name' => 'group_invitations',
                'label' => 'Who can invite',
                'type' => 'text',
            ],
            [
                'name' => 'image',
                'label' => 'Project Image',
                'type' => 'text',
            ],
            [
                'name' => 'created_at',
                'label' => 'Created at',
                'type' => 'date'
            ],
            [
                'name' => 'updated_at',
                'label' => 'Updated at',
                'type' => 'date'
            ]
        ]);
    }
        
    protected function setupCreateOperation()
    {

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
                'name' => 'status',
                'label' => 'Status',
                'type' => 'select_from_array',
                'options' => [
                    'Public' => 'Public',
                    'Private' => 'Private',
                    'Hidden' => 'Hidden'
                ],
            ],
            [
                'name' => 'group_invitations',
                'label' => 'Who can invite',
                'type' => 'select_from_array',
                'options' => [
                    'all_members' => 'All group members',
                    'group_admins' => 'Group admins only',
                ],
            ],
            [
                'name' => 'image',
                'label' => 'Project Image',
                'type' => 'text',
            ],
        ]);
    }

    

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
