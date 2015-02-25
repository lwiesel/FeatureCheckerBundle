<?php

namespace LWI\FeatureCheckerBundle\Twig;

/**
 * GlobalsExtension
 *
 * Makes global twig variables out of features lists
 */
class GlobalsExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    private $features;

    /**
     * @param array $features
     */
    public function __construct($features)
    {
        $this->features = $features;
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return array(
            'feature_checker' => $this->features,
        );
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'feature_checker';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getNamespace().'.globals_extension';
    }
}
