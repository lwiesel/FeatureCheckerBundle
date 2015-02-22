<?php

namespace Lwiesel\FeatureCheckerBundle\EventListener;

use Lwiesel\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ExceptionListener {
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!($exception instanceof FeatureNotActivatedException)) {
            return;
        }

        $kernel = $event->getKernel();

        $attributes = [
            '_controller' => 'FeatureCheckerBundle:Exception:notActivated',
            'exception' => $exception,
        ];

        $subRequest = $event->getRequest()->duplicate(array(), null, $attributes);
        $response = $kernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);

        $event->setResponse($response); // this will stop event propagation
    }
}
