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
        CRUD::setEntityNameStrings('projectxlsform', 'project Xlsforms');
    }
    
    protected function setupListOperation()
    {
        $this->crud->setColumns([
            [
                'name' => 'project_id',
                'label' => 'Project Name',
                'type' => 'select',
                'entity' => 'projects',
                'attribute' => 'name',
                'model' => Project::class,
            ],
            // [
            //     'name' => 'xlsform_id',
            //     'label' => 'Xls Form',
            //     'type' => 'select',
            //     'entity' => 'xlsforms',
            //     'attribute' => 'form_title',
            //     'model' => Xlsform::class,
            // ],
            
            // [
            //     'name' => 'form_kobo_id',
            //     'label' => 'form_kobo_id',
            //     'type' => 'number',
            // ],
            
        ]);
    }
        
    protected function setupCreateOperation()
    {

        $this->crud->addFields([
            [
                'name' => 'project_id',
                'label' => 'Project',
                'type' => 'select2',
                'entity' => 'projects',
                'attribute' => 'name',
                'model' => Project::class,
            ],
            [
                'name' => 'xlsform',
                'label' => 'Name of the Project',
                'type' => 'text',
            ],
            
           
        ]);
    }

    

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    
}
