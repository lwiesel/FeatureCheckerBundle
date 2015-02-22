<?php

namespace ChessyWeb\FeatureCheckerBundle\Controller;

use ChessyWeb\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
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
