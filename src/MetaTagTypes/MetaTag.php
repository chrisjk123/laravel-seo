<?php

namespace Chriscreates\Seo\MetaTagTypes;

class MetaTag extends Tag
{
    /**
     * @var string
     */
    public string $content = '';

    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var array
     */
    public array $attributes = [
        'content',
        'name',
    ];
}
