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
     * Constructor
     *
     * @param string $featureName
     */
    public function __construct($featureName)
    {
        $message = sprintf("The feature '%s' is not activated.", $featureName);

        parent::__construct($message, 500, null);
    }
}
