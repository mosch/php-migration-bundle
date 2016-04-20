<?php
namespace MigrationBundle\Command;

use Migration\VersionTransducer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateUpCommand extends ContainerAwareCommand
{
  protected function configure()
    {
        $this
            ->setName('migration:up')
            ->setDescription('Generates a valid version name')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'If set, the migrations will be executed')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var VersionTransducer $migrator */
        $migrator = $this->getContainer()->get('migrations.migrator');

        $migrations = $migrator->getOpenMigrations();

        $output->writeln("There are ".count($migrations)." migrations to be done:");

        foreach ($migrations as $migration) {
            $output->writeln(' - '.$migration->getVersionName());
        }

        if ($input->getOption('force')) {
            $migrator->migrateUp();
            $output->writeln('done');
        }

    }
}