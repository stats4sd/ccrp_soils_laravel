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
        $this->crud->setColumns([
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
                'type' => 'date',

            ],
            [
                'name' => 'form_id',
                'label' => 'File',
                'type' => 'closure',
                'function' => function($entry){
                    $file = $entry->form_id;
                    return '<a href="'.url('/uploads/'.$file.'').'" target="_blank">'.$file.'</a>';
                } 
            ],
            [
                'name' => 'link_page',
                'label' => 'Page',
                'type' => "closure",
                'function' => function($entry){
                    $page = $entry->link_page;
                    return '<a href="'.url(''.$page.'').'" target="_blank">'.$page.'</a>';
                } 
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'text',
            ],
        ]);
        
    
        $this->crud->addFields([

            [
                'name' => 'form_title',
                'label' => 'Form Title',
                'type' => 'text',
                'hint' => '<b>Choose a title for the downloads page</b>',
                'attributes' => [
                'required' => true,
            ],
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
                'type' => 'date',
                'default' => today(),
                'hint' => '<b>Insert the date of uploading the new form</b>',
                'attributes' => [
                'required' => true,
            ],


            ],
            [   // Upload
                'name' => 'form_id',
                'label' => 'File',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'uploads' ,
                'hint' => '<b>Upload the file that you want to download from the downloads page</b>',
            ],
            [
                'name' => 'link_page',
                'label' => 'Page',
                'type' => 'url',
                'hint' => '<b>Insert the page tha you want to link from the downloads page</b>',
            ],
            [   // CKEditor
                'name' => 'description',
                'label' => 'Description',
                'type' => 'simplemde',
                'hint' => '<b>Insert a description that you want to display for the form</b>',
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
