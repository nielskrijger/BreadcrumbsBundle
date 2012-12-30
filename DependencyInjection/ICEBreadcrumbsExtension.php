<?php

namespace ICE\BreadcrumbsBundle\DependencyInjection;

use ICE\BreadcrumbsBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class ICEBreadcrumbsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('breadcrumbs.xml');
        $loader->load('twig.xml');

        if (isset($config['template']))
        {
            $container->setParameter('ice.breadcrumbs.twig.template', $config['template']);
        }
    }
}