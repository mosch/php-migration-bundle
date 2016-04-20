<?php
namespace MigrationBundle\Migration;

use Doctrine\Common\Persistence\ObjectManager;
use Migration\MigrationInterface;

abstract class DoctrineMigration implements MigrationInterface
{
    protected $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    abstract public function getVersionName();

    abstract public function migrate();
}