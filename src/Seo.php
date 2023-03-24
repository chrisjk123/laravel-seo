<?php

namespace Chriscreates\Seo;

use Chriscreates\Seo\MetaTagTypes\Canonical;
use Chriscreates\Seo\MetaTagTypes\Link;
use Chriscreates\Seo\MetaTagTypes\MetaTag;
use Chriscreates\Seo\MetaTagTypes\OpenGraph;
use Chriscreates\Seo\MetaTagTypes\Title;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Str;

/**
 * @method static getTitle()
 * @method static setTitle()
 * @method static getDescription()
 * @method static setDescription()
 */
class Seo
{
    use Conditionable;

    /**
     * The page title.
     */
    protected string $title = '';

    /**
     * The page description.
     */
    protected string $description = '';

    /**
     * The page meta tags.
     */
    protected array $meta = [];

    /**
     * Keywords
     *
     * @var array
     */
    protected $keywords = [];

    /**
     * @return array
     */
    public function toArray(): array
    {
        $seo = config('seo');

        $title = collect([
            $seo['title']['prepend'] ?? '',
            $this->title,
            $seo['title']['append'] ?? '',
        ])
        ->filter()
        ->implode($seo['title']['deliminator'] ?? '');

        $metaTags = collect(array_merge([
            'title' => $title,
            'description' => $this->description,
            'keywords' => implode(', ', $this->keywords),
        ], Arr::get($seo, 'meta', [])))
            ->filter()
            ->map(function($value, $key) {
                return new MetaTag([
                    'name' => $key,
                    'content' => $value,
                ]);
            })
            ->values()
            ->toArray();

        $opengraph = collect(array_merge([
            'title' => $title,
            'description' => $this->description,
            'url' => Request::getUri(),
        ], Arr::get($seo, 'opengraph', [])))
            ->map(function($value, $key) {
                return new OpenGraph([
                    'property' => "og:{$key}",
                    'content' => $value,
                ]);
            })
            ->values()
            ->toArray();

        return array_merge(
            [
                new Title([
                    'value' => $title,
                ]),
                new Link([
                    'rel' => 'shortcut icon',
                    'type' => 'image/png',
                    'href' => $seo['logo'],
                ]),
                new Canonical([
                    'rel' => 'canonical',
                    'href' => Request::getUri(),
                ])
            ],
            $metaTags, 
            $opengraph,
        );
    }

    /**
     * Factory method.
     */
    public static function make(): static
    {
        return new static();
    }

    public function get(string $key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }

        // TODO
    }

    public function set(string $key, $value)
    {
        if (property_exists($this, $key)) {
            $this->{$key} = $value;
            Session::put("meta.{$key}", $value);
        } else {
            $this->meta[$key] = $value;
        }

        return $this;
    }

    public function __get(string $key)
    {
        return $this->get($key);
    }

    public function __set(string $key, string $value)
    {
        return $this->set($key, $value);
    }

    public function __call(string $method, array $arguments)
    {

        if (Str::startsWith($method, 'set')) {
            $property = Str::of($method)->after('set')->lower();

            if (property_exists($this, $property)) {
                return $this->set($property, $arguments[0]);
            }
        }

        $property = Str::of($method)->after('get')->lower();

        if (property_exists($this, $property)) {
            return $this->get($property);
        }

        return $this;
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
