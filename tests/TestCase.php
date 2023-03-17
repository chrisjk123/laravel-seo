<?php

namespace Chriscreates\Seo\Tests;

use Chriscreates\Seo\Providers\SeoServiceProvider;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use LazilyRefreshDatabase;

    protected $loadEnvironmentVariables = true;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            SeoServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // ...
    }

    protected function setUpDatabase($app)
    {
        // ...
    }
}
