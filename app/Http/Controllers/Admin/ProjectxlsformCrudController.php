<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectxlsformRequest as StoreRequest;
use App\Http\Requests\ProjectxlsformRequest as UpdateRequest;
use App\Models\Project;
use App\Models\Xlsform;
use Backpack\CRUD\CrudPanel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectxlsformCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProjectxlsformCrudController extends CrudController
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
        CRUD::setModel('App\Models\Projectxlsform');
        CRUD::setRoute(config('backpack.base.route_prefix') . '/projectxlsform');
        CRUD::setEntityNameStrings('project xlsform', 'project Xlsforms');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns([
            [
                'name' => 'project_id',
                'label' => 'Project',
                'type' => 'select',
                'entity' => 'project',
                'attribute' => 'name',
                'model' => Project::class,
            ],
            [
                'name' => 'xlsform_id',
                'label' => 'Select the xls form for this project',
                'type' => 'select',
                'entity' => 'xls_form',
                'attribute' => 'title',
                'model' => Xlsform::class,
            ],
            [
                'name' => 'form_kobo_id',
                'label' => 'Form kobo id',
                'type' => 'number',
            ],
            [
                'name' => 'kobo_version_id',
                'label' => 'Kobotoolbox deployment version_id',
                'type' => 'checkbox',
            ],
            [
                'name' => 'records',
                'label' => 'Number of records',
                'type' => 'number',
            ],
            [
                'name' => 'form_kobo_id_string',
                'label' => 'Form kobo id string',
                'type' => 'text',
            ],

        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'project_id',
                'label' => 'Project Name',
                'type' => 'select2',
                'entity' => 'project',
                'attribute' => 'name',
                'model' => Project::class,
            ],
            [
                'name' => 'xlsform_id',
                'label' => 'Select the xls form for this project',
                'type' => 'select2',
                'entity' => 'xls_form',
                'attribute' => 'title',
                'model' => Xlsform::class,
            ],
            [
                'name' => 'form_kobo_id',
                'label' => 'Form kobo id',
                'type' => 'number',
            ],
            [
                'name' => 'kobo_version_id',
                'label' => 'Is the form deployed?',
                'type' => 'checkbox',
            ],
            [
                'name' => 'records',
                'label' => 'Number of records',
                'type' => 'number',
            ],
            [
                'name' => 'form_kobo_id_string',
                'label' => 'Form kobo id string',
                'type' => 'text',
            ],

        ]);
    }



    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }


}
