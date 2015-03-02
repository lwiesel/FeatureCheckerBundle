<?php

namespace spec\LWI\FeatureCheckerBundle\Annotations\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use LWI\FeatureCheckerBundle\Annotations\MustHaveFeature;
use LWI\FeatureCheckerBundle\Tests\AppBundle\Controller\TestController;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class FeatureCheckerDriverSpec extends ObjectBehavior
{
    protected $properFeatures = array(
        'test' => true,
        'test-2' => false,
        'test-3' => array(
            'test-31' => true,
            'test-32' => true,
        ),
        'test-4' => array(
            'test-41' => true,
            'test-42' => false,
        )
    );

    function it_is_initializable(Reader $reader)
    {
        $this->beConstructedWith($reader, $this->properFeatures);
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Annotations\Driver\FeatureCheckerDriver');
    }

    function it_should_throw_an_exception_when_the_annotated_feature_is_disabled(
        Reader $annotationReader,
        FilterControllerEvent $filterControllerEvent
    ) {
        $this->test_annotations($annotationReader, $filterControllerEvent, array(
            'test-4.test-42',
        ));

        $this
            ->shouldThrow('LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException')
            ->during('onFilterController', array($filterControllerEvent))
        ;
    }

    function it_should_not_throw_an_exception_when_the_annotated_feature_is_enabled(
        Reader $annotationReader,
        FilterControllerEvent $filterControllerEvent
    ) {
        $this->test_annotations($annotationReader, $filterControllerEvent, array(
            'test',
            'test-3',
        ));

        $this->onFilterController($filterControllerEvent)->shouldReturn(null);
    }

    function it_should_not_throw_an_exception_when_there_is_no_annotation(
        Reader $annotationReader,
        FilterControllerEvent $filterControllerEvent
    ) {
        $this->test_annotations($annotationReader, $filterControllerEvent, array());

        $this->onFilterController($filterControllerEvent)->shouldReturn(null);
    }

    function test_annotations(
        Reader $annotationReader,
        FilterControllerEvent $filterControllerEvent,
        array $featureNames
    ) {
        $testController = new TestController();
        $actionName = 'testAction';

        $reflexionMethod = new \ReflectionMethod($testController, $actionName);

        $annotations = array();
        foreach ($featureNames as $feature) {
            $annotations[] = new MustHaveFeature(array('value' => $feature));
        }

        $annotationReader->getMethodAnnotations($reflexionMethod)->willReturn($annotations);

        $this->beConstructedWith($annotationReader, $this->properFeatures);

        $filterControllerEvent
            ->getController()
            ->willReturn(array($testController, $actionName));
    }
}
