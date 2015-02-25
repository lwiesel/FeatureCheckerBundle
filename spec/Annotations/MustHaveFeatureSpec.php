<?php

namespace spec\LWI\FeatureCheckerBundle\Annotations;

use PhpSpec\ObjectBehavior;

class MustHaveFeatureSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(array('value' => 'feature-name'));
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Annotations\MustHaveFeature');
    }

    function it_should_throw_error_if_no_feature_name_is_injected()
    {
        $parameters = array();
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', array($parameters));

        $parameters = array('undefined_param' => 'value');
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', array($parameters));
    }

    function it_should_throw_error_if_undefined_parameter_is_injected()
    {
        $parameters = array('value' => 'feature-name', 'undefined_param' => 'value');
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', array($parameters));
    }

    function it_should_return_feature_name()
    {
        $this->beConstructedWith(array('value' => 'feature-name'));
        $this->getFeatureName()->shouldReturn('feature-name');
    }
}
