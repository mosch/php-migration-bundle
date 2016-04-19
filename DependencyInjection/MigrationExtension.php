<?php
namespace MigrationBundle\DependencyInjection;

use MigrationBundle\DoctrineVersionProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
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

        $doctrineProvider = new Definition(DoctrineVersionProvider::class);
        $doctrineProvider->setArguments();

        $container->addDefinitions([
            'migrations.doctrine_provider' => $doctrineProvider,
        ]);
        //version_class
        foreach (new \DirectoryIterator($config['dir_name']) as $item) {
            if (!$item->isFile()) {
                continue;
            } 
            
            $class = $config[$config['namespace']] + basename($item->getFilename(), '.php');
            $service->addMethodCall('addMigration', $class);
        }
    }

}