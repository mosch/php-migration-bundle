<?php
namespace MigrationBundle\Command;

use Migration\VersionTransducer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateVersionCommand extends Command
{
  protected function configure()
    {
        $this
            ->setName('migration:generate-version')
            ->setDescription('Generates a valid version name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(VersionTransducer::createVersionName());
    }
}