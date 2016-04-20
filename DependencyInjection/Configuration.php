<?php
namespace MigrationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('migration', 'array');

        $rootNode
            ->children()
                ->scalarNode('namespace')->defaultValue('Application\Migrations')->cannotBeEmpty()->end()
                ->scalarNode('dir_name')->cannotBeEmpty()->end()
                ->scalarNode('version_class')->cannotBeEmpty()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}