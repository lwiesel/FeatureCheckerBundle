<?php

namespace Lwiesel\FeatureCheckerBundle\Twig;

class GlobalsExtension extends \Twig_Extension
{
    private $features;

    public function __construct($features)
    {
        $this->features = $features;
    }

    public function getGlobals()
    {
        return array_merge(parent::getGlobals(), [
            'feature_checker' => $this->features,
        ]);
    }

    public function getName()
    {
        return 'feature_checker.globals_extension';
    }
}
