<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\XlsformRequest as StoreRequest;
use App\Http\Requests\XlsformRequest as UpdateRequest;
use App\Models\Xlsform;
use Backpack\CRUD\CrudPanel;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class XlsformCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class XlsformCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Xlsform');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/xlsform');
        $this->crud->setEntityNameStrings('xlsform', 'xlsforms');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        // add asterisk for fields that are required in XlsformRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->addColumns([
            [
                'name' => 'form_title',
                'label' => 'Form Title',
                'type' => 'text',
            ],
            [
                'name' => 'default_language',
                'label' => 'Language',
                'type' => 'text',
            ],
            [
                'name' => 'version',
                'label' => 'Version',
                'type' => 'text',
            ],
            [
                'name' => 'form_id',
                'label' => 'File',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'uploads',
            ],
        ]);

        $this->crud->addFields([

            // [
            //     'name' => 'form_title',
            //     'label' => 'Form Title',
            //     'type' => 'select_from_array',
            //     'options' => Xlsform::get()->pluck('form_title', 'id')->toArray(),
            //     'priority' => 1,
            // ],
            [
                'name' => 'form_title',
                'label' => 'Form Title',
                'type' => 'text',
            ],
            [
                'name' => 'default_language',
                'label' => 'Language',
                'type' => 'select_from_array',
                'options' => ['english' => 'English', 'spanish' => 'Spanish'],
                'allows_null' => false, 
                'default' => 'english',
            ],
            [
                'name' => 'version',
                'label' => 'Version',
                'type' => 'dateTime',
                'default' => now(),

            ],
            [   // Upload
                'name' => 'form_id',
                'label' => 'File',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'uploads' // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],
        ]);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
