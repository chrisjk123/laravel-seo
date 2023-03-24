<?php

namespace Chriscreates\Seo\MetaTagTypes;

use Spatie\DataTransferObject\DataTransferObject;

abstract class Tag extends DataTransferObject
{
    /**
     * @var string
     */
    public string $tag = 'meta';

    /**
     * @var array
     */
    public array $attributes = [];

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];

        if (empty($this->attributes)) {
            return $attributes;
        }

        foreach($this->attributes as $attribute) {
            $attributes[$attribute] = $this->{$attribute};
        }

        return $attributes;
    }

    /**
     * @return string
     */
    public function toHtml(): string
    {
        $element = "<".$this->tag;
        

        $attributes = $this->getAttributes();

        if(count($attributes)) {
            foreach($attributes as $key => $value) {
                $element .= " ".$key."=\"".$value."\"";
            }
        }

        if (property_exists($this, 'value')) {
            $element.= ">{$this->value}</{$this->tag}>";
        } else {
            $element.= " />";
        }


        return $element;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->toHtml();
    }
}
