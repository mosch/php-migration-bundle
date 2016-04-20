<?php
namespace MigrationBundle;

use MigrationBundle\DependencyInjection\MigrationCompilerPass;
use MigrationBundle\DependencyInjection\MigrationExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MigrationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MigrationCompilerPass());
    }

    public function getContainerExtension()
    {
        return new MigrationExtension();
    }
}