<?php

namespace LWI\FeatureCheckerBundle;

use LWI\FeatureCheckerBundle\DependencyInjection\FeatureCheckerExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FeatureCheckerBundle extends Bundle
{
    /**
     * Add extension to container
     *
     * @return ExtensionInterface|null
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FeatureCheckerExtension();
        }

        return $this->extension;
    }
}
