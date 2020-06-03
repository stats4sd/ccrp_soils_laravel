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
        if($xlsform->live) {
            $projects = Project::all()->pluck('id')->toArray();
            $xlsform->projects()->sync($projects);
        }

    }

    /**
     * Handle the xlsform "updated" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function updated(Xlsform $xlsform)
    {
        if ($xlsform->live) {
            $projects = Project::all()->pluck('id')->toArray();
            $xlsform->projects()->sync($projects);
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
        // dispatch( new DeleteKobotoolsForm($xlsform->kobo_id));
    }


}
