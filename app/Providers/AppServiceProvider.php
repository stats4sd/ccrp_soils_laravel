<?php

namespace App\Providers;

use App\Models\Invite;
use App\Models\Project;
use App\Models\User;
use App\Models\Xlsform;
use App\Observers\InviteObserver;
use App\Observers\ProjectObserver;
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
        Xlsform::observe(XlsformObserver::class);
        Project::observe(ProjectObserver::class);
        Invite::observe(InviteObserver::class);
        User::observe(UserObserver::class);
    }



}
