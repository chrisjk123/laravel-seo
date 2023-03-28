<?php

namespace Chriscreates\Seo\Tests;

class GetMetaTest extends TestCase
{
    /** @test */
    public function it_can_get_some_defined_metadata_from_the_config()
    {
        $this->assertEquals('Laravel', seo()->get('opengraph', 'site_name'));
    }

    /** @test */
    public function it_can_dynamically_get_metadata_from_the_config()
    {
        $this->assertEquals('Laravel', seo()->getSiteName('opengraph'));
    }

    /** @test */
    public function it_can_get_some_defined_metadata_set_on_the_handler_class()
    {
        seo()->setImage('opengraph', 'someimage.png');

        $this->assertEquals('someimage.png', seo()->get('opengraph', 'image'));
    }

    /** @test */
    public function it_can_dynamically_get_some_defined_metadata_set_on_the_handler_class()
    {
        seo()->setImage('opengraph', 'someimage.png');

        $this->assertEquals('someimage.png', seo()->getImage('opengraph'));
    }
}
