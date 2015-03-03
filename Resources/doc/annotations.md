# Using annotations on actions

Features can be checked in controller annotations. Only the allowed features will execute the action.

``` php
// src/AppBundle/Controller/DefaultController.php

namespace AppBundle\Controller;

use LWI\FeatureCheckerBundle\Annotations\MustHaveFeature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @MustHaveFeature("feature1")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
```

Sub-features can be checked with this notation:

``` php
    /**
     * @MustHaveFeature("feature1")
     * @MustHaveFeature("feature3.feature31")
     */
    public function secondAction()
    {
        return $this->render('default/second.html.twig');
    }
```

You can also test whole feature sets. A feature set is considered enabled when all sub-features -at any sub-level- is enabled.

``` php
    /**
     * @MustHaveFeature("feature3")
     */
    public function thirdAction()
    {
        return $this->render('default/third.html.twig');
    }
```

Next step: [Using service in actions](service.md)