<?php
namespace AppBundle\Command;

use Migration\VersionTransducer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateUpCommand extends Command
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
        $output->writeln(VersionTransducer::createVersionName());
    }
}