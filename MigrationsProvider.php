<?php
namespace MigrationBundle;

use Symfony\Component\HttpKernel\KernelInterface;
use DirectoryIterator;

class MigrationProvider
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getMigrations()
    {
        $kernel = $this->kernel;
        foreach (new DirectoryIterator($kernel->getRootDir().'/Migrations/') as $file) {
            print $file->getFilename();
        }
    }
}