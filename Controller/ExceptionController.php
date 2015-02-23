<?php

namespace LWI\FeatureCheckerBundle\Controller;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExceptionController extends Controller
{
    public function notActivatedAction(FeatureNotActivatedException $exception)
    {
        return $this->render('FeatureCheckerBundle:exception:featureNotActivated.html.twig', [
            'featureName' => $exception->getMessage(),
        ]);
    }
}
