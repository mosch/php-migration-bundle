<?php
namespace MigrationBundle\DependencyInjection;

use MigrationBundle\DoctrineVersionProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MigrationExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        foreach ($config as $key => $value) {
            $container->setParameter('migrations' . '.' . $key, $value);
        }

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $service = $container->getDefinition('migrations.migrator');
        $migrationServices = [];

        foreach (new \DirectoryIterator($config['dir_name']) as $item) {
            if (!$item->isFile()) {
                continue;
            }
            $className = basename($item->getFilename(), '.php');

            $migrationDefinition = new Definition($config['namespace'] . '\\' . $className);
            $migrationDefinition->setPublic(false);
            $migrationServices['migration.migrations.'.strtolower($className)] = $migrationDefinition;
        }

        $container->addDefinitions($migrationServices);

        foreach (array_keys($migrationServices) as $id) {
            $service->addMethodCall('addMigration', [new Reference($id)]);
        }

    }

}