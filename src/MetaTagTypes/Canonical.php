<?php

namespace Chriscreates\Seo\MetaTagTypes;

use Illuminate\Support\Facades\Request;

class Canonical extends Tag
{
    /**
     * @var string
     */
    public string $tag = 'link';

    /**
     * @var string
     */
    public string $rel = 'canonical';

    /**
     * @var string
     */
    public string $href = '';

    /**
     * @var array
     */
    public array $attributes = [
        'href',
        'rel',
    ];
}
