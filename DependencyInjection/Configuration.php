<?php

namespace ICE\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('breadcrumbs')
            ->children()
                ->scalarNode('trail_class')
                    ->defaultValue('ICE\BreadcrumbsBundle\Model\Trail')
                    ->end()
                ->end()
            ->end()
        ;
        return $builder;
    }
}