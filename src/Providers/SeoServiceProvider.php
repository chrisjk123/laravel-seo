<?php

namespace Chriscreates\Seo\Providers;

use Chriscreates\Seo\Seo;
use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Routing\Route;
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

        Route::macro('title', function (string $title) {
            seo()->setTitle($title);

            return $this;
        });

        Route::macro('description', function (string $description) {
            seo()->setDescription($description);

            return $this;
        });
        
        PendingResourceRegistration::macro('title', function (string $title) {
            seo()->setTitle($title);

            return $this;
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/seo.php',
            'seo'
        );

        $this->app->singleton('seo', Seo::class);
    }
}
