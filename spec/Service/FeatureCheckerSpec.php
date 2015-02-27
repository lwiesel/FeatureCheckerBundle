<?php

namespace spec\LWI\FeatureCheckerBundle\Service;

use PhpSpec\ObjectBehavior;

class FeatureCheckerSpec extends ObjectBehavior
{
    protected $properFeatures = array(
        'test' => true,
        'test-2' => false,
        'test-3' => array(
            'test-31' => true
        )
    );

    function it_is_initializable()
    {
        $this->beConstructedWith($this->properFeatures);
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Service\FeatureChecker');
    }
}
