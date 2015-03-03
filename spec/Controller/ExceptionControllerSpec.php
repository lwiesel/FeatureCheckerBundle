<?php

namespace spec\LWI\FeatureCheckerBundle\Controller;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\Container;

class ExceptionControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Controller\ExceptionController');
    }

    function it_should_return_an_error_page(
        Container $container,
        EngineInterface $templating
    ) {
        $container->get('templating')->willReturn($templating);
        $this->setContainer($container);

        $templating->renderResponse(
            'FeatureCheckerBundle:exception:featureNotActivated.html.twig',
            array(
                'message' => 'The feature \'feature-name\' is not activated.',
                'featureName' => 'feature-name'
            ),
            null
        )->shouldBeCalled();

        $this->notActivatedAction(new FeatureNotActivatedException('feature-name'));
    }
}
