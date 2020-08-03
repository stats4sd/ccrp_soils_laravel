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
        $this->syncFormWithProject($xlsform);
    }

    /**
     * Handle the xlsform "updated" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function updated(Xlsform $xlsform)
    {
        $this->syncFormWithProject($xlsform);
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

    public function syncFormWithProject (Xlsform $xlsform)
    {
        if ($xlsform->live) {

            if ($xlsform->public) {
                $projects = Project::all()->pluck('id')->toArray();
                $xlsform->projects()->sync($projects);
            } else {
                $xlsform->projects()->sync($xlsform->project_id);
            }
        }
    }



}
