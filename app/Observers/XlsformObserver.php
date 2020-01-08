<?php

namespace App\Observers;

use App\Jobs\PublishNewFormToKobotools;
use App\Xlsform;

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
        dispatch( new PublishNewFormToKobotools($xlsform));
    }

    /**
     * Handle the xlsform "updated" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function updated(Xlsform $xlsform)
    {
        dispatch( new UpdateExitingFormOnKobotools($xlsform));
    }

    /**
     * Handle the xlsform "deleted" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function deleted(Xlsform $xlsform)
    {
        //
    }

    /**
     * Handle the xlsform "restored" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function restored(Xlsform $xlsform)
    {
        //
    }

    /**
     * Handle the xlsform "force deleted" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function forceDeleted(Xlsform $xlsform)
    {
        //
    }
}
