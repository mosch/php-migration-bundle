<?php
namespace MigrationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MigrationCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition(
            'migrations.migrator'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'migration'
        );
        
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addMigration',
                array(new Reference($id))
            );
        }
    }
}