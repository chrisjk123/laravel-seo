<?php

namespace Chriscreates\Seo\MetaTagTypes;

class Link extends Tag
{
    /**
     * @var string
     */
    public string $tag = 'link';

    /**
     * @var string
     */
    public string $rel;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $href;

    /**
     * @var array
     */
    public array $attributes = [
        'rel',
        'type',
        'href',
    ];
}
