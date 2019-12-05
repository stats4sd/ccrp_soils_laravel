<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\XlsformRequest as StoreRequest;
use App\Http\Requests\XlsformRequest as UpdateRequest;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use Backpack\CRUD\CrudPanel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class XlsformCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class XlsformCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        CRUD::setModel('App\Models\Xlsform');
        CRUD::setRoute(config('backpack.base.route_prefix') . '/xlsform');
        CRUD::setEntityNameStrings('xlsform', 'xlsforms');

    }

    protected function setupListOperation()
    {
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
                'name' => 'path_file',
                'label' => 'File',
                'type' => 'closure',
                'function' => function($entry){
                    $file = $entry->path_file;
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
    }
        
    protected function setupCreateOperation()
    {

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
                'name' => 'path_file',
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

    

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        Projectxlsform::where('xlsform_id', $id)->update(['deployed'=>0]);


    }
    public function update(UpdateRequest $request, $id)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        Projectxlsform::where('xlsform_id', $id)->update(['deployed'=>0]);


        return $redirect_location;
    }
}
