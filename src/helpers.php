<?php

use Chriscreates\Seo\Seo;

if (! function_exists('seo')) {
    /**
     * @param  string|array  $key
     * @return mixed
     */
    function seo(string|array $key = null): Seo|string|array|null
    {
        if ($key === null) {
            return app('seo');
        }

        if (is_array($key)) {
            return app('seo')->set($key);
        }

        return app('seo')->get($key);
    }
}