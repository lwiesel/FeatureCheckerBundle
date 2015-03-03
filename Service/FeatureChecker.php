<?php

namespace LWI\FeatureCheckerBundle\Service;

use LWI\FeatureCheckerBundle\Exception\FeatureNotActivatedException;
use LWI\FeatureChecker\FeatureChecker as Checker;

class FeatureChecker {
    /**
     * @var FeatureChecker
     */
    protected $checker;

    /**
     * @var bool
     */
    protected $disableUndefined;

    /**
     * Constructor
     *
     * @param bool $disableUndefined
     * @param array $featuresConfiguration
     */
    public function __construct($disableUndefined, $featuresConfiguration)
    {
        $this->disableUndefined = $disableUndefined;
        $this->checker = new Checker($featuresConfiguration);
    }


    /**
     * Check given feature -or set of features-
     *
     * @param $featureName
     * @throws FeatureNotActivatedException
     */
    public function check($featureName)
    {
        if (!$this->checker->isFeatureEnabled($featureName)) {
            throw new FeatureNotActivatedException($featureName);
        }
    }
}
