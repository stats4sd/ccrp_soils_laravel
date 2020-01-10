<?php

namespace App\Observers;

use App\Jobs\DeleteKobotoolsForm;
use App\Jobs\PublishNewFormToKobotools;
use App\Jobs\PushFormFileToKobotools;
use App\Models\Project;
use App\Models\Xlsform;
use Illuminate\Support\Arr;

class XlsformObserver
{
    /**
     * Handle the xlsform "created" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function created(Xlsform $xlsform)
    {
        dispatch( new PushFormFileToKobotools($xlsform));

        $projects = Project::all()->pluck('id')->toArray();
        $xlsform->projects()->sync($projects);

    }

    /**
     * Handle the xlsform "updated" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function updated(Xlsform $xlsform)
    {

        $changes = $xlsform->getChanges();


        if(
            isset($changes['form_title'])
            || isset($changes['path_file'])
            || isset($changes['media'])
        ) {
            dispatch( new PushFormFileToKobotools($xlsform));
        }

    }

    /**
     * Handle the xlsform "deleted" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function deleted(Xlsform $xlsform)
    {
        dispatch( new DeleteKobotoolsForm($xlsform->kobo_id));
    }


}
