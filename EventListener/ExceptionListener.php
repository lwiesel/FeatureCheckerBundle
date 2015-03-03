<?php

namespace LWI\FeatureCheckerBundle\EventListener;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use LWI\FeatureChecker\Exception\FeatureNotDefinedException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * ExceptionListener
 */
class ExceptionListener {
    /**
     * Is true is undefined feature should be considered disabled
     * @var bool
     */
    protected $disableUndefined;

    /**
     *  Constructor
     */
    function __construct($disableUndefined)
    {
        $this->disableUndefined = $disableUndefined;
    }


    /**
     * Makes exception controller handle response
     *
     * @param GetResponseForExceptionEvent $event
     * @return void
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (
            (($exception instanceof FeatureNotDefinedException) && !$this->disableUndefined)
            || (!($exception instanceof FeatureNotActivatedException) && !($exception instanceof FeatureNotDefinedException))
        ) {
            return;
        }

        $attributes = array(
            '_controller' => 'FeatureCheckerBundle:Exception:notActivated',
            'exception' => new FeatureNotActivatedException($exception->getFeatureName()),
        );

        $subRequest = $event->getRequest()->duplicate(array(), null, $attributes);
        $response = $event->getKernel()->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);

        $event->setResponse($response); // this will stop event propagation
    }
}
