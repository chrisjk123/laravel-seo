<?php

namespace Chriscreates\Seo\MetaTagTypes;

class OpenGraph extends Tag
{
    /**
     * @var string
     */
    public string $content = '';

    /**
     * @var string
     */
    public string $property = 'og:';

    /**
     * @var array
     */
    public array $attributes = [
        'content',
        'property',
    ];
}
