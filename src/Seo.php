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
            call_user_func($callback, $this, $title, $this->description);
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
     * Undocumented function
     *
     * @param string $key
     * 
     * @return mixed
     */
    public function get(string $key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }

        // TODO
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

    public function __get(string $key)
    {
        return $this->get($key);
    }

    public function __set(string $key, string $value)
    {
        return $this->set('meta', $key, $value);
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
