<?php

namespace ChessyWeb\FeatureCheckerBundle\Twig;

use Symfony\Component\DependencyInjection\Container;

class GlobalsExtension extends \Twig_Extension
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getGlobals()
    {
        $features = $this->container->getParameter('feature_checker.features');

        return array_merge(parent::getGlobals(), [
            'feature_checker' => $features,
        ]);
    }

    public function getName()
    {
        return 'feature_checker.globals_extension';
    }
}
