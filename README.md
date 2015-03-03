# FeatureCheckerBundle

[![Packagist](https://img.shields.io/packagist/v/lwiesel/feature-checker-bundle.svg)](https://packagist.org/packages/lwiesel/feature-checker-bundle)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/lwiesel/FeatureCheckerBundle/master.svg?style=flat-square)](https://travis-ci.org/lwiesel/FeatureCheckerBundle)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/lwiesel/FeatureCheckerBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/lwiesel/FeatureCheckerBundle/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/lwiesel/FeatureCheckerBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/lwiesel/FeatureCheckerBundle)
[![HHVM](https://img.shields.io/hhvm/lwiesel/feature-checker-bundle.svg)](http://hhvm.h4cc.de/package/lwiesel/feature-checker-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/lwiesel/feature-checker-bundle.svg?style=flat-square)](https://packagist.org/packages/lwiesel/feature-checker-bundle)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/45f2f618-d33b-405f-91f8-0f840a6ccf7d/big.png)](https://insight.sensiolabs.com/projects/45f2f618-d33b-405f-91f8-0f840a6ccf7d)

Define features, and check if they are activated or not in your Symfony2 application.

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
            feature32: true
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
}
```

## Installation

Please see [Full documentation](Resources/doc/index.md) for details.

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
