<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DataMapStoreRequest;
use App\Http\Requests\DataMapUpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DataMapCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DataMapCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\DataMap');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/datamap');
        $this->crud->setEntityNameStrings('datamap', 'data_maps');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id',
                'label' => 'value',
            ],
            [
                'name' => 'title',
                'label' => 'label'
            ],
        ]);
    }

    protected function setupCreateOperation()
{
        $this->crud->setValidation(DataMapStoreRequest::class);

        $this->crud->addFields([
            [
                'name' => 'id',
                'type' => 'text',
                'label' => 'value',
            ],
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'label',
            ],
            [
                'name' => 'variables',
                'label' => 'What variables does this data map check for in the ODK?',
                'type' => 'table',
                'entity_singular' => 'variable',
                'columns' => [
                    'name' => 'variable name',
                    'label' => 'label',
                ],
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->modifyField('id', [
            'attributes' => [
                'disabled' => true,
            ],
        ]);
        $this->crud->setValidation(DataMapUpdateRequest::class);
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id',
                'label' => 'value',
            ],
            [
                'name' => 'title',
                'label' => 'label'
            ],
            [
                'name' => 'variables',
                'label' => 'What variables does this data map check for in the ODK?',
                'type' => 'table',
                'entity_singular' => 'variable',
                'columns' => [
                    'name' => 'variable name',
                    'label' => 'label',
                ],
            ],

        ]);
    }
}
