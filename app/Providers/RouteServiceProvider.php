<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Route;
use Tio\Laravel\Facade as Translation;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //from https://laracasts.com/discuss/channels/laravel/optional-language-for-all-routes

        Route::pattern('_locale', \implode('|', $this->app['config']['app.available_locales']));

        Route::matched(function (RouteMatched $event) {
            // Get language from route.
            $locale = $event->route->parameter('_locale');

            // Ensure, that all built urls would have "_locale" parameter set from url.
            url()->defaults(array('_locale' => $locale));

            // Change application locale.
            app()->setLocale($locale);
            Translation::setLocale($locale);
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        // Added "->prefix(...` line to auto-prefix all routes with locale.

        Route::middleware('web')
             ->namespace($this->namespace)
             ->prefix('{_locale}')
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
