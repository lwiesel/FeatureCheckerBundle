<?php

namespace spec\LWI\FeatureCheckerBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FeatureCheckerExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LWI\FeatureCheckerBundle\DependencyInjection\FeatureCheckerExtension');
    }

    function it_should_return_its_alias()
    {
        $this->getAlias()->shouldBeString();
    }

    function it_should_set_parameters_to_container(ContainerBuilder $container)
    {
        $configs = array($this->getWrappedObject()->getAlias() => array(
            'disable_undefined' => true,
            'features' => array(
                'test' => true,
                'test-2' => false,
                'test-3' => array(
                    'test-31' => true,
                    'test-32' => true,
                ),
            ),
        ));

        $this->load($configs, $container);

        $container->setParameter(
            $this->getWrappedObject()->getAlias().'.disable_undefined',
            $configs[$this->getWrappedObject()->getAlias()]['disable_undefined']
        )->shouldBeCalled();

        // TODO: implement this test
//        $container->setParameter(
//            $this->getWrappedObject()->getAlias().'.features',
//            $configs[$this->getWrappedObject()->getAlias()]['features']
//        )->shouldBeCalled();
    }
}
