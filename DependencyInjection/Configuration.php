<?php

namespace ICE\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ice_breadcrumbs');

        $rootNode
            ->children()
                ->scalarNode('trail_class')
                    ->defaultValue('ICE\BreadcrumbsBundle\Model\Trail')
                ->end()
                ->scalarNode('template')
                    ->defaultValue('ICEBreadcrumbsBundle::breadcrumbs.html.twig')
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}