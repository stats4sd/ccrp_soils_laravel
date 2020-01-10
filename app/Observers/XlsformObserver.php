<?php

namespace App\Observers;

use App\Jobs\DeleteKobotoolsForm;
use App\Jobs\PublishNewFormToKobotools;
use App\Jobs\PushFormFileToKobotools;
use App\Models\Xlsform;

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
    }

    /**
     * Handle the xlsform "updated" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function updated(Xlsform $xlsform)
    {

        $original = $xlsform->getOriginal();

        if(
            $xlsform->form_title != $original['form_title']
            || $xlsform->path_file != $original['path_file']
            || $xlsform->media != $original['media']
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
