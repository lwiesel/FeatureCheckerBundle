<?php

namespace spec\LWI\FeatureCheckerBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LWI\FeatureCheckerBundle\DependencyInjection\Configuration');
    }

    function it_should_return_a_tree_builder()
    {
        $this->getConfigTreeBuilder()->shouldReturnAnInstanceOf('Symfony\Component\Config\Definition\Builder\TreeBuilder');
    }
}
