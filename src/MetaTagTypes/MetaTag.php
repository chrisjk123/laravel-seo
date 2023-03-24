<?php

namespace Chriscreates\Seo\MetaTagTypes;

class MetaTag extends Tag
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $content;

    /**
     * @var array
     */
    public array $attributes = [
        'name',
        'content',
    ];
}
