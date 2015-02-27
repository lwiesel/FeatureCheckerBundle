# Overriding error controller

The error controller can be overriden to add features before the rendering of the error template.

First, create a new bundle and override the `getParent` method in the bundle class.

``` php
// src/Acme/FeatureCheckerBundle/FeatureCheckerBundle.php

namespace Acme\FeatureCheckerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FeatureCheckerBundle';
    }
}
```

**Note:**

    The Symfony2 framework only allows a bundle to have one child. You cannot create another bundle that is also a child of FOSUserBundle.

Now that you have created the new child bundle you can simply create a controller class with the same name and in the same location as the one you want to override.

``` php
// src/Acme/FeatureCheckerBundle/Controller/ExceptionController.php

namespace Acme\FeatureCheckerBundle\Controller;

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
        /*
        Do additional code here, change rendering, etc.
         */

        return $this->render('FeatureCheckerBundle:exception:featureNotActivated.html.twig', array(
            'message' => $exception->getMessage(),
            'featureName' => $exception->getFeatureName(),
        ));
    }
}
```
