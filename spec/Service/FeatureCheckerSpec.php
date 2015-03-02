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
        $this->beConstructedWith(true, $this->properFeatures);
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Service\FeatureChecker');
    }

    function it_should_throw_an_exception_if_target_feature_is_disabled()
    {
        $this->beConstructedWith(true, $this->properFeatures);
        $this
            ->shouldThrow('LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException')
            ->during('check', array('test-2'))
        ;

        $this->check('test')->shouldReturn(null);
    }
}
