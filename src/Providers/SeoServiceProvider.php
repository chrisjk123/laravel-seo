<?php

namespace Chriscreates\Seo\Providers;

use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'seo');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/seo'),
        ], 'seo-views');

        $this->publishes([
            __DIR__.'/../../config/seo.php' => config_path('seo.php'),
        ], 'seo-config');
    }

    public function register()
    {
        $this->registerConfiguration();
    }

    protected function registerConfiguration()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/seo.php',
            'seo'
        );
    }
}
