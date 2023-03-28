<?php

namespace Chriscreates\Seo\Tests;

class OpenGraphTest extends TestCase
{
    /** @test */
    public function it_contains_a_opengraph_tags()
    {
        $this->assertStringContainsString('<meta content="en_GB" property="og:locale" />', $this->viewData());
        $this->assertStringContainsString('<meta content="website" property="og:type" />', $this->viewData());
        $this->assertStringContainsString('<meta content="Laravel" property="og:site_name" />', $this->viewData());
        $this->assertStringContainsString('<meta content="Laravel" property="og:title" />', $this->viewData());
        $this->assertStringContainsString('<meta content="http://localhost/" property="og:url" />', $this->viewData());
    }

    /** @test */
    public function it_can_override_an_existing_opengraph_tag()
    {
        seo()->setSiteName('opengraph', 'chriscreates');

        $this->assertStringContainsString('<meta content="chriscreates" property="og:site_name" />', $this->viewData());
    }

    /** @test */
    public function it_can_add_a_new_opengraph_tag()
    {
        seo()->setImage('opengraph', 'someimage.png');

        $this->assertStringContainsString('<meta content="someimage.png" property="og:image" />', $this->viewData());
    }
}
