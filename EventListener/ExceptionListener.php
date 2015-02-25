<?php

namespace LWI\FeatureCheckerBundle\EventListener;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * ExceptionListener
 */
class ExceptionListener {
    /**
     * Makes exception controller handle response
     *
     * @param GetResponseForExceptionEvent $event
     * @return void
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!($exception instanceof FeatureNotActivatedException)) {
            return;
        }

        $attributes = array(
            '_controller' => 'FeatureCheckerBundle:Exception:notActivated',
            'exception' => $exception,
        );

        $subRequest = $event->getRequest()->duplicate(array(), null, $attributes);
        $response = $event->getKernel()->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);

        $event->setResponse($response); // this will stop event propagation
    }
}
