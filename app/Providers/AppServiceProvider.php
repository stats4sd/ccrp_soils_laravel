<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Xlsform;
use App\Observers\ProjectObserver;
use App\Observers\XlsformObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
    }



}
