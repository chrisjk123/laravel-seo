<?php

namespace Chriscreates\Seo\Tests;

class DefaultMetaTest extends TestCase
{
    /** @test */
    public function it_contains_a_title_tag()
    {
        $this->assertStringContainsString('<title value="Laravel">Laravel</title>', $this->viewData());
    }

    /** @test */
    public function it_contains_a_description_that_can_be_set_tag()
    {
        seo()->setDescription('Some description here');

        $this->assertStringContainsString('<meta content="Some description here" name="description" />', $this->viewData());
    }

    /** @test */
    public function it_contains_a_favicon_tag()
    {
        $this->assertStringContainsString('<link href="favicon.png" rel="shortcut icon" type="image/png" />', $this->viewData());
    }

    /** @test */
    public function it_contains_a_canonical_tag()
    {
        $this->assertStringContainsString('<link href="http://localhost/" rel="canonical" />', $this->viewData());
    }
}
