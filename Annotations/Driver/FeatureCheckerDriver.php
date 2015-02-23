<?php

namespace LWI\FeatureCheckerBundle\Annotations\Driver;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use LWI\FeatureCheckerBundle\Exception\FeatureNotDefinedException;
use LWI\FeatureCheckerBundle\Annotations\MustHaveFeature;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class FeatureCheckerDriver
{
    protected $annotationReader;
    protected $featuresConfiguration;

    public function __construct(Reader $annotationReader, $featuresConfiguration)
    {
        $this->annotationReader = $annotationReader;
        $this->featuresConfiguration = $featuresConfiguration;
    }

    /**
     * This event will fire during any controller call
     */
    public function onFilterController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        list($object, $method) = $controller;

        // the controller could be a proxy, e.g. when using the JMSSecuriyExtraBundle or JMSDiExtraBundle
        $className = ClassUtils::getClass($object);

        $reflectionClass = new \ReflectionClass($className);
        $reflectionMethod = $reflectionClass->getMethod($method);

        $allAnnotations = $this->annotationReader->getMethodAnnotations($reflectionMethod);

        $featureCheckerAnnotations = array_filter($allAnnotations, function($annotation) {
            return $annotation instanceof MustHaveFeature;
        });

        foreach ($featureCheckerAnnotations as $featureCheckerAnnotation) {
            $featureName = $featureCheckerAnnotation->getFeatureName();

            if (!in_array($featureName, array_keys($this->featuresConfiguration))) {
                throw new FeatureNotDefinedException($featureName);
            } else if (!$this->featuresConfiguration[$featureName]) {
                throw new FeatureNotActivatedException($featureName);
            }
        }
    }
}
