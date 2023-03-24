<?php

namespace Chriscreates\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getTitle()
 * @method static setTitle()
 * @method static getDescription()
 * @method static setDescription()
 */
class Seo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seo';
    }
}