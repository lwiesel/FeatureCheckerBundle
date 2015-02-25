# FeatureChecker

[![Packagist](https://img.shields.io/packagist/v/lwiesel/feature-checker-bundle.svg)](https://packagist.org/packages/lwiesel/feature-checker-bundle)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/lwiesel/FeatureCheckerBundle/master.svg?style=flat-square)](https://travis-ci.org/lwiesel/FeatureCheckerBundle)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/lwiesel/FeatureCheckerBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/lwiesel/FeatureCheckerBundle/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/lwiesel/FeatureCheckerBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/lwiesel/FeatureCheckerBundle)
[![HHVM](https://img.shields.io/hhvm/lwiesel/feature-checker-bundle.svg)](http://hhvm.h4cc.de/package/lwiesel/feature-checker-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/lwiesel/feature-checker-bundle.svg?style=flat-square)](https://packagist.org/packages/lwiesel/feature-checker-bundle)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cdfe22bc-1889-43a2-a416-3a06e2f6f2d3/big.png)](https://insight.sensiolabs.com/projects/cdfe22bc-1889-43a2-a416-3a06e2f6f2d3)

Define features, and check if they are activated or not in your Symfony2 application.

## Install

Via Composer

``` bash
$ composer require lwiesel/feature-checker-bundle
```

## Usage

Define a feature configuration in your `config.yml`.

``` yaml
# app/config/config.yml

feature_checker:
    features:
        feature1: true
        feature2: false
        feature3:
            feature31: true
```

Then use the features names in controller annotations. Only the allowed features will execute the action.

``` php
<?php
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

    /**
     * @MustHaveFeature("feature1")
     * @MustHaveFeature("feature3.feature31")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
```

## Installation

The installation takes 3 steps:

1. Download FeatureCheckerBundle using composer
2. Enable the bundle
3. Configure your application's config.yml

### Step1: Download FeatureCheckerBundle using composer
Add FOSUserBundle by running the command:

``` bash
$ php composer.phar require lwiesel/feature-checker-bundle "~1.0"
```

Composer will install the bundle to your project's `vendor/lwiesel` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new LWI\FeatureCheckerBundle\FeatureCheckerBundle(),
    );
}
```

### Step 3: Configure your application's config.yml

Below is an example of the configuration necessary to use the FeatureCheckerBundle in your application:

``` yaml
# app/config/config.yml

feature_checker:
    features:
        # List here your features
        feature1: true
        feature2: false
        # You can also nest features
        feature3:
            feature31: true
```
## Testing

``` bash
$ bin/phpspec run
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for details.

## Security

If you discover any security related issues, please email [wiesel.laurent@gmail.com](wiesel.laurent@gmail.com) instead of using the issue tracker.

## Credits

- [Laurent Wiesel](https://github.com/lwiesel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
