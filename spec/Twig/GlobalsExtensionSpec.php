<?php

namespace spec\LWI\FeatureCheckerBundle\Twig;

use PhpSpec\ObjectBehavior;

class GlobalsExtensionSpec extends ObjectBehavior
{
    protected $features = array(
        'test' => true,
        'test-2' => false,
        'test-3' => array(
            'test-31' => true
        )
    );

    function let()
    {
        $this->beConstructedWith($this->features);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Twig\GlobalsExtension');
    }

    function it_should_return_its_namespace()
    {
        $this->getNamespace()->shouldBeString();
    }

    function it_should_return_its_name()
    {
        $this->getName()->shouldBeString();
    }

    function it_should_return_globals()
    {
        $this->getGlobals()->shouldReturn(array($this->getNamespace()->getWrappedObject() => $this->features));
    }
}
