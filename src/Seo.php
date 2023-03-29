<?php

namespace Chriscreates\Seo;

use Chriscreates\Seo\MetaTagTypes\Canonical;
use Chriscreates\Seo\MetaTagTypes\Link;
use Chriscreates\Seo\MetaTagTypes\Title;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Str;

/**
 * @method static getTitle()
 * @method static setTitle()
 */
class Seo
{
    use Conditionable;

    /**
     * The page title.
     */
    protected string $title = '';

    /**
     * Keywords.
     *
     * @var array
     */
    protected $keywords = [];

    /**
     * Registered custom metadata.
     *
     * @var array
     */
    protected $metadata = [];

    /**
     * @var array
     */
    public $callbacks;

    /**
     * Register a new callback to be executed before 
     * printing the metadata in a blade view.
     *
     * @param callable $callback
     * @return $this
     */
    public function registerCallback(callable $callback)
    {
        $this->callbacks[] = $callback;

        return $this;
    }

    /**
     * Transform the metadata within the config, 
     * as well as the custom metadata registered
     * into an array to be used within the blade view.
     * 
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

        foreach($this->callbacks as $callback) {
            call_user_func($callback, $this, [
                'title' => $title,
                'keywords' => $this->keywords,
            ]);
        }

        $arrays = [
            [
                new Title($title),
                new Link($seo['logo']),
                new Canonical(Request::getUri()),
            ],
        ];

        foreach($seo['metadata'] as $metaType => $seoMetaData) {
            $arrays[] = collect($seoMetaData['metadata'])
                ->filter()
                ->merge($this->metadata[$metaType] ?? [])
                ->mapInto($seoMetaData['class'])
                ->values()
                ->toArray();
        }

        return Arr::flatten($arrays);
    }

    /**
     * Dynamically get metadata.
     *
     * @param string $config
     * @param string $key
     * 
     * @return mixed
     */
    public function get(string $config = 'meta', string $key)
    {
        if (property_exists($this, $config)) {
            return $this->{$config};
        }

        if (!isset($this->metadata[$config])) {
            return config("seo.metadata.{$config}.metadata.{$key}");
        }

        return $this->metadata[$config][$key];
    }

    /**
     * Set some custom metadata to be used within the blade view.
     *
     * @param string $config
     * @param string $key
     * @param string $value
     * 
     * @return $this
     */
    public function set(string $config = 'meta', string $key, string $value)
    {
        $this->metadata[$config] = array_merge(
            $this->metadata[$config] ?? [], 
            [
                Str::snake($key) => $value,
            ]
        );

        return $this;
    }

    public function __call(string $method, array $arguments)
    {
        if (Str::startsWith($method, 'set')) {
            $property = Str::of($method)->after('set');

            if (count($arguments) === 1) {
                $property = $property->lower();
                
                if (property_exists($this, $property)) {
                    $this->{$property} = $arguments[0];

                    return $this;
                }
            }

            return $this->set($arguments[0], $property, $arguments[1]);
        }

        if (Str::startsWith($method, 'get')) {
            return $this->get(
                $arguments[0], 
                Str::of($method)->after('get')->snake()->lower()
            );
        }
        
        return $this;
    }
}
