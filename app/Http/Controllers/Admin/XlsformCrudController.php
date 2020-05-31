<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Requests\XlsformRequest as StoreRequest;
use App\Http\Requests\XlsformRequest as UpdateRequest;
use App\Jobs\DeployFormToKobo;
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
        Crud::button('deploy')
        ->stack('line')
        ->view('crud::buttons.deploy');

        $this->crud->setColumns([
            [
                'name' => 'title',
                'label' => 'Form Title',
                'type' => 'text',
            ],
            [
                'name' => 'version',
                'label' => 'Version - Uploaded',
                'type' => 'date',
            ],
            [
                'name' => 'kobo_id',
                'label' => 'View on Kobotools',
                'type' => 'closure',
                'function' => function($entry) {
                    if($entry->kobo_id) {
                        return "<a href='https://kf.kobotoolbox.org/#/forms/".$entry->kobo_id."'>Kobotoolbox Link</a>";
                    }
                    return "<span class='text-secondary'>Not Deployed</span>";
                },
            ],
            [
                'name' => 'live',
                'label' => 'Is Form Available to Projects?',
                'type' => 'boolean',
            ],
            [
                'name' => 'xlsfile',
                'label' => 'XLSForm File',
                'type' => 'closure',
                'function' => function($entry){
                    $file = $entry->file;
                    return '<a href="'.url('/uploads/'.$file.'').'" target="_blank">'.$file.'</a>';
                }
            ],
            [
                'name' => 'link_page',
                'label' => 'Associated Guide(s)',
                'type' => "closure",
                'function' => function($entry){
                    $page = $entry->link_page;
                    return '<a href="'.url(''.$page.'').'" target="_blank">'.$page.'</a>';
                },

            ],
            [
                'name' => 'media',
                'label' => 'Attached Media Files',
                'type' => 'text',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {

        $this->crud->addFields([

            [
                'name' => 'title',
                'label' => 'Form Title',
                'type' => 'text',
                'hint' => '<b>Choose a title for the downloads page</b>',
            ],
            [
                'name' => 'version',
                'label' => 'Version',
                'type' => 'date',
                'default' => today(),
                'hint' => '<b>Insert the date of uploading the new form</b>',
            ],
            [   // Upload xls form
                'name' => 'xlsfile',
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
            [
                'name' => 'media',
                'label' => 'Upload media File',
                'type' => 'upload_multiple',
                'upload' => true,
                'disk' => 'uploads',
            ],
        ]);
    }



    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function deployToKobo(Xlsform $xlsform)
    {
        DeployFormToKobo::dispatch($xlsform, auth()->user(), 'admin');

        return response()->json([
            'title' => $xlsform->title,
            'user' => auth()->user()->email,
        ]);
    }

}
