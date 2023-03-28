<?php

namespace Chriscreates\Seo\Tests;

use Chriscreates\Seo\Seo;

class CallbackTest extends TestCase
{
    /** @test */
    public function it_can_define_and_call_a_callback()
    {
        seo()->registerCallback(function(Seo $seo) {
            return $seo->setSiteName('opengraph', 'chriscreates');
        });

        $this->assertStringContainsString('<meta content="chriscreates" property="og:site_name" />', $this->viewData());
    }

    /** @test */
    public function it_stays_present_even_when_other_callbacks_are_registered()
    {
        seo()->setImage('opengraph', 'test.png');

        $this->assertStringContainsString('<meta content="test.png" property="og:image" />', $this->viewData());
    }
}
