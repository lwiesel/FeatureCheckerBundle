<?php

namespace LWI\FeatureCheckerBundle;

use LWI\FeatureCheckerBundle\DependencyInjection\FeatureCheckerExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FeatureCheckerBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FeatureCheckerExtension();
        }

        return $this->extension;
    }
}
