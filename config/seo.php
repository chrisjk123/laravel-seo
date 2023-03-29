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

    'logo' => 'favicon.png',

    'metadata' => [

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
            'class' => \Chriscreates\Seo\MetaTagTypes\OpenGraph::class,
            'metadata' => [
                // 'image' => '',
                // 'description' => '',
                'locale' => 'en_GB',
                'type' => 'website',
                'site_name' => config('app.name'),
            ],
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
            'class' => \Chriscreates\Seo\MetaTagTypes\MetaTag::class,
            'metadata' => [
                // 'msapplication-TileColor' => '#ffffff',
                // 'description' => '',
                'theme-color' => '#ffffff',
                'generator' => config('app.name'),
            ],
        ],
    ],
];
