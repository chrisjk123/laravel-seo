<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title Tag
    |--------------------------------------------------------------------------
    |
    | This option defines the title of the document, shown within the browser's 
    | title bar or in the page's tab.
    |
    | You can choose to prepend, append and set a deliminator between them all.
    |
    */

    'title' => [
        'prepend' => '',
        'append' => config('app.name'),
        'deliminator' => ' - ',
    ],

    /*
    |--------------------------------------------------------------------------
    | Favicon Tag
    |--------------------------------------------------------------------------
    |
    | Path to the site's favicon.
    |
    */

    'logo' => 'logo.png',

    /*
    |--------------------------------------------------------------------------
    | OpenGraph Tag
    |--------------------------------------------------------------------------
    |
    | The key will be the property attribute value.
    | The value will be the content attribute value.
    |
    | <meta property="og:locale" content="en_GB" />
    |
    */

    'opengraph' => [
        'locale' => 'en_GB',
        'image' => '', // TODO
        'type' => 'website',
        'site_name' => config('app.name'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Meta Tags
    |--------------------------------------------------------------------------
    |
    | <meta name="generator" content="MyAppName" />
    |
    */

    'meta' => [
        // 'msapplication-TileColor' => '#ffffff',
        // 'theme-color' => '#ffffff',
        // 'google-site-verification' => '',
        'generator' => config('app.name'),
    ],

];
