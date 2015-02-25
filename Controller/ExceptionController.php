<?php

namespace LWI\FeatureCheckerBundle\Controller;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * ExceptionController
 *
 * Handles rendering of error pages
 */
class ExceptionController extends Controller
{
    /**
     * Feature not activated
     *
     * @param FeatureNotActivatedException $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function notActivatedAction(FeatureNotActivatedException $exception)
    {
        return $this->render('FeatureCheckerBundle:exception:featureNotActivated.html.twig', array(
            'featureName' => $exception->getMessage(),
        ));
    }
}
