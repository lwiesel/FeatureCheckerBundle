<?php

namespace spec\LWI\FeatureCheckerBundle\Exception;

use PhpSpec\ObjectBehavior;

class FeatureNotActivatedExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('feature-name');
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException');
    }
}
