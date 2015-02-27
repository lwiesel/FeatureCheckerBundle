# Overriding error template

The default error template is very simple :

``` twig
<h1>Error with feature {{ featureName }}</h1>

<p>{{ message }}</p>
```

`featureName` being the tested feature which appeared unabled.
`message` being the default exception message.

There are 2 ways to override this template:
1. Define a new template of the same name in the app/Resources directory (easy)
2. Create a new bundle that is defined as a child of FeatureCheckerBundle (advanced)

## Method 1: Define new template in app/Resources
Just add a new file in `app/Resources/FeatureChecker/views/exception`, named `featureNotActivated.html.twig`.

The `featureName` and `message` will still be accessible in the new template.

## Method 2: Create a child bundle

**Note:**

    This method is more complicated than the one outlined above.
    Unless you are planning to override the controllers as well as the
    templates, it is recommended that you use the other method.

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

By returning the name of the bundle in the `getParent` method of your bundle class, you are telling the Symfony2 framework that your bundle is a child of the FeatureCheckerBundle.

Now that you have declared your bundle as a child of the FeatureCheckerBundle, you can override the parent bundle's templates. To override the error template, simply create a new file in the `src/Acme/FeatureCheckerBundle/Resources/views` directory named `featureNotActivated.html.twig`. Notice how this file resides in the same exact path relative to the bundle directory as it does in the FeatureCheckerBundle.

After overriding a template in your child bundle, you must clear the cache for the override to take effect, even in a development environment.

Next step: [Overriding error controller](overriding_controller.md)