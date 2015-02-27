# Installation

The installation takes 2 steps:

1. Download FeatureCheckerBundle using composer
2. Enable the bundle

## Step1: Download FeatureCheckerBundle using composer
Add FeatureCheckerBundle by running the command:

``` bash
$ php composer.phar require lwiesel/feature-checker-bundle "~1.1"
```

Composer will install the bundle to your project's `vendor/lwiesel` directory.

## Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new LWI\FeatureCheckerBundle\FeatureCheckerBundle(),
    );
}
```

Next step: [Configuration](configuration.md)