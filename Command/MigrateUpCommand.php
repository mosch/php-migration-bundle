<?php
namespace MigrationBundle\Command;

use Migration\VersionTransducer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateUpCommand extends ContainerAwareCommand
{
  protected function configure()
    {
        $this
            ->setName('migration:up')
            ->setDescription('Generates a valid version name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var VersionTransducer $migrator */
        $migrator = $this->getContainer()->get('migrations.migrator');

        $output->writeln("There are ".count($migrator->getOpenMigrations())." migrations to be done");
    }
}