<?php

namespace LWI\FeatureCheckerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('feature_checker');

        $rootNode
            ->children()
                ->booleanNode('disable_undefined')
                    ->defaultFalse()
                    ->info('If true, undefined feature will be considered as disabled.')
                ->end()
                ->arrayNode('features')
                    ->prototype('boolean')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
