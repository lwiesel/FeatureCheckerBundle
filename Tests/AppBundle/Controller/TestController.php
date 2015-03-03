<?php

namespace LWI\FeatureCheckerBundle\Tests\AppBundle\Controller;

use LWI\FeatureCheckerBundle\Annotations\MustHaveFeature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    /**
     *  This method has no annotation
     *  It is used for mocking purpose
     */
    public function testAction()
    {
        /*
         * This method does nothing.
         * It is used for testing purpose
        */
    }
}
