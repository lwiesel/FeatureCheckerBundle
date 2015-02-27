<?php

namespace LWI\FeatureCheckerBundle\Exception;

/**
 * FeatureNotActivatedException
 *
 * Overrides default exception message. Must be constructed with a feature name.
 */
class FeatureNotActivatedException extends \Exception
{
    /**
     * @var string
     */
    protected $featureName;

    /**
     * Constructor
     *
     * @param string $featureName
     */
    public function __construct($featureName)
    {
        $this->featureName = $featureName;

        $message = sprintf("The feature '%s' is not activated.", $featureName);

        parent::__construct($message, 500, null);
    }

    /**
     * Get feature name
     *
     * @return string
     */
    public function getFeatureName()
    {
        return $this->featureName;
    }
}
