<?php

namespace Chriscreates\Seo\MetaTagTypes;

class OpenGraph extends Tag
{
    /**
     * @var string
     */
    public string $property;

    /**
     * @var string
     */
    public string $content;

    /**
     * @var array
     */
    public array $attributes = [
        'property',
        'content',
    ];
}
