<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Xlsform;
use App\Models\User;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        // ensure creator of the project is an admin
        $user = User::find($project->creator_id);
        $project->users()->attach($user, ['admin' => true]);

        $project->xls_forms()->sync(Xlsform::where('live', '=', true)->where('public', '=', true)->get());

    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\App\Models\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  \App\App\Models\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  \App\App\Models\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
