<?php

namespace LWI\FeatureCheckerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * FeatureCheckerExtension
 */
class FeatureCheckerExtension extends Extension implements ExtensionInterface
{
    /**
     * Load bundle configuration
     *
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter($this->getAlias().'.disable_undefined', $config['disable_undefined']);

        // Sets features list in container
        $container->setParameter($this->getAlias().'.features', $config['features']);
    }

    /**
     * The extension alias
     *
     * @return string
     */
    public function getAlias()
    {
        return 'feature_checker';
    }
}
