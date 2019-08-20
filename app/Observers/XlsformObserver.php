<?php

namespace App\Observers;

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
        // pass the file

        // parse the file

        // add lots of variables
    }

    /**
     * Handle the xlsform "updated" event.
     *
     * @param  \App\Xlsform  $xlsform
     * @return void
     */
    public function updated(Xlsform $xlsform)
    {
        // delete existing variables

        // as above, so below
        //
        //
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
