<?php

namespace spec\LWI\FeatureCheckerBundle\EventListener;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use LWI\FeatureChecker\Exception\FeatureNotDefinedException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Kernel;

class ExceptionListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(true);
        $this->shouldHaveType('LWI\FeatureCheckerBundle\EventListener\ExceptionListener');
    }

    function it_should_return_if_exception_is_not_feature_undefined_or_feature_disabled(
        GetResponseForExceptionEvent $event,
        \Exception $exception
    ) {
        $event->getException()->willReturn($exception);

        $this->beConstructedWith(false);
        $this->onKernelException($event)->shouldReturn(null);
    }

    function it_should_return_if_exception_is_feature_undefined_and_undefined_parameter_is_false(
        GetResponseForExceptionEvent $event,
        FeatureNotDefinedException $exception
    ) {
        $event->getException()->willReturn($exception);

        $this->beConstructedWith(false);
        $this->onKernelException($event)->shouldReturn(null);
    }

    function it_should_send_a_sub_request_when_exception_is_feature_disabled(
        GetResponseForExceptionEvent $event,
        FeatureNotActivatedException $exception,
        Kernel $kernel,
        Request $request,
        Response $response
    ) {
        $this->beConstructedWith(false);

        $request->duplicate(array(), null, Argument::type('array'))->willReturn(new Request());

        $kernel->handle(
            Argument::type('Symfony\Component\HttpFoundation\Request'),
            HttpKernelInterface::SUB_REQUEST,
            false
        )->willReturn($response);

        $event->getException()->willReturn($exception);
        $event->getRequest()->willReturn($request);
        $event->getKernel()->willReturn($kernel);

        $kernel->handle(
            Argument::type('Symfony\Component\HttpFoundation\Request'),
            HttpKernelInterface::SUB_REQUEST,
            false
        )->shouldBeCalled();

        $event->setResponse(
            Argument::type('Symfony\Component\HttpFoundation\Response')
        )->shouldBeCalled();

        $this->onKernelException($event);
    }
}
