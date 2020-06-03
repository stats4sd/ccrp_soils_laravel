<?php

namespace App\Providers;

use App\Models\Invite;
use App\Models\Project;
use App\Models\ProjectSubmission;
use App\Models\User;
use App\Models\Xlsform;
use App\Observers\InviteObserver;
use App\Observers\ProjectObserver;
use App\Observers\ProjectSubmissionObserver;
use App\Observers\UserObserver;
use App\Observers\XlsformObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Invite::observe(InviteObserver::class);
        Project::observe(ProjectObserver::class);
        ProjectSubmission::observe(ProjectSubmissionObserver::class);
        User::observe(UserObserver::class);
        Xlsform::observe(XlsformObserver::class);

    }



}
