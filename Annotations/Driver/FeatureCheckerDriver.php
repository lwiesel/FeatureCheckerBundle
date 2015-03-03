<?php

namespace LWI\FeatureCheckerBundle\Annotations\Driver;

use LWI\FeatureChecker\FeatureChecker;
use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use LWI\FeatureCheckerBundle\Annotations\MustHaveFeature;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * FeatureCheckerDriver
 *
 * Handles FeatureChecker annotations
 */
class FeatureCheckerDriver
{
    /**
     * @var Reader
     */
    protected $annotationReader;

    /**
     * @var FeatureChecker
     */
    protected $checker;

    /**
     * Constructor
     *
     * @param Reader $annotationReader
     * @param $featuresConfiguration
     */
    public function __construct(Reader $annotationReader, $featuresConfiguration)
    {
        $this->annotationReader = $annotationReader;
        $this->checker = new FeatureChecker($featuresConfiguration);
    }

    /**
     * This event will fire during any controller call
     *
     * @param FilterControllerEvent $event
     * @return void
     * @throws FeatureNotActivatedException
     */
    public function onFilterController(FilterControllerEvent $event)
    {
        $featureCheckerAnnotations = $this->getFeatureCheckerAnnotations($event);

        foreach ($featureCheckerAnnotations as $featureCheckerAnnotation) {
            $featureName = $featureCheckerAnnotation->getFeatureName();

            if (!$this->checker->isFeatureEnabled($featureName)) {
                throw new FeatureNotActivatedException($featureName);
            }
        }
    }

    /**
     * Get action feature checker annotations from event
     *
     * @param FilterControllerEvent $event
     * @return MustHaveFeature[]
     */
    protected function getFeatureCheckerAnnotations(FilterControllerEvent $event)
    {
        list($object, $method) = $event->getController();

        // the controller could be a proxy,
        // e.g. when using the JMSSecuriyExtraBundle or JMSDiExtraBundle
        $className = ClassUtils::getClass($object);

        $reflectionClass = new \ReflectionClass($className);
        $reflectionMethod = $reflectionClass->getMethod($method);

        $allAnnotations = $this->annotationReader->getMethodAnnotations($reflectionMethod);

        $allAnnotations = is_array($allAnnotations) ? $allAnnotations : array();

        // Filter FeatureChecker annotation, especially MustHaveFeature
        return array_filter($allAnnotations, function($annotation) {
            return $annotation instanceof MustHaveFeature;
        });
    }
}
