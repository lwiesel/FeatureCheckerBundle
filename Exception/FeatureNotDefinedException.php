<?php

namespace Lwiesel\FeatureCheckerBundle\Exception;

use Exception;

class FeatureNotDefinedException extends \Exception
{
    public function __construct($featureName)
    {
        $message = sprintf("No configuration found for feature '%s'.\n\rDid you forget to add it to your config file?", $featureName);

        parent::__construct($message, 500, null);
    }
}
