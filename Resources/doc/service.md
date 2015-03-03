# Using service in actions

Features can also be checked directly in controller actions, through the FeatureChecker service.

``` php
// src/AppBundle/Controller/DefaultController.php

namespace AppBundle\Controller;

use LWI\FeatureCheckerBundle\Annotations\MustHaveFeature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // Get the FeatureChecker service
        $checker = $this->container->get('feature_checker.checker');

        // If the feature is not enabled, this action will stop and an error page will be shown.
        $checker->check('feature1');

        return $this->render('default/index.html.twig');
    }
}
```

Next step: [Using Twig global variables](twig_variables.md)