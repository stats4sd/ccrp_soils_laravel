<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton('commonmark', function() {
            return new CommonMarkConverter();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('markdown', function($expression) {
            return "<?php echo app('commonmark')->convertToHtml($expression); ?>";
        });

    }
}
