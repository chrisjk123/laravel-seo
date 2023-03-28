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
    public string $href = '';

    /**
     * @var string
     */
    public string $rel = 'shortcut icon';

    /**
     * @var string
     */
    public string $type = 'image/png';

    /**
     * @var array
     */
    public array $attributes = [
        'href',
        'rel',
        'type',
    ];
}
