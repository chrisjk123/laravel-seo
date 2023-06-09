<?php

namespace Chriscreates\Seo\Providers;

use Chriscreates\Seo\Seo;
use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Request;
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

        seo()->registerCallback(function(Seo $seo, array $properties) {
            $seo->setTitle('meta', $properties['title']);
            $seo->setKeywords('meta', implode(', ', $properties['keywords']));
            $seo->setUrl('meta', Request::getUri());

            $seo->setTitle('opengraph', $properties['title']);
            $seo->setUrl('opengraph', Request::getUri());
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
