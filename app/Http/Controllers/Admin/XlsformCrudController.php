<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Xlsform;
use Backpack\CRUD\CrudPanel;
use App\Jobs\ArchiveKoboForm;
use App\Jobs\GetDataFromKobo;
use App\Jobs\DeployFormToKobo;
use App\Models\ProjectXlsform;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\XlsformRequest as StoreRequest;
use App\Http\Requests\XlsformRequest as UpdateRequest;
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
                'type' => 'text',
                'label' => 'Choose a title for the downloads page',
            ],
            [   // Upload xls form
                'name' => 'xlsfile',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public' ,
                'label' => 'Upload the XLS Form file',
            ],
            [
                'name' => 'link_page',
                'type' => 'url',
                'label' => 'Add the url to the online guide for this form',
            ],
            [   // CKEditor
                'name' => 'description',
                'type' => 'simplemde',
                'label' => 'Add a description for the form',
            ],
            [
                'name' => 'media',
                'label' => 'Upload any csv or image files required by the ODK form',
                'type' => 'upload_multiple',
                'upload' => true,
                'disk' => 'public',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function setupShowOperation ()
    {
        $this->crud->set('show.setFromDb', false);

        Crud::button('deploy')
        ->stack('line')
        ->view('crud::buttons.deploy');

        Crud::button('sync')
        ->stack('line')
        ->view('crud::buttons.sync');

        Crud::button('archive')
        ->stack('line')
        ->view('crud::buttons.archive');

        $form = $this->crud->getCurrentEntry();

        Widget::add([
            'type' => 'view',
            'view' => 'crud::widgets.xlsform_kobo_info',
            'form' => $form,
        ])->to('after_content');

        $this->crud->addColumns([
            [
                'name' => 'title',
                'label' => 'Title',
                'type' => 'text'
            ],
            [
                'name' => 'link_page',
                'label' => 'Guide for this Form',
                'type' => 'text',
                'wrapper' => [
                    'href' => function($crud, $column, $entry, $related_key) {
                        return $entry->link_page;
                    }
                ]
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'textarea'
            ],
            [
                'name' => 'xlsfile',
                'label' => 'XLS Form File',
                'type' => 'upload',
                'limit' => 1000,
                'wrapper' => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return Storage::disk('public')->url($entry->xlsfile);
                    }                ]
            ],
            [
                'name' => 'media',
                'label' => 'Attached Media files (csv / images)',
                'type' => 'upload_multiple'
            ],
        ]);
    }


    public function deployToKobo(Xlsform $xlsform)
    {
        DeployFormToKobo::dispatch(auth()->user(), $xlsform);

        return response()->json([
            'title' => $xlsform->title,
            'user' => auth()->user()->email,
        ]);
    }

    public function syncData (Xlsform $xlsform)
    {
        GetDataFromKobo::dispatchNow(auth()->user(), $xlsform);

        $submissions = $xlsform->submissions;

        return $submissions->toJson();
    }

    public function archiveOnKobo (Xlsform $xlsform)
    {
       ArchiveKoboForm::dispatch(auth()->user(), $xlsform);

       return response()->json([
           'title' => $xlsform->title,
           'user' => auth()->user()->email,
       ]);

    }


}
