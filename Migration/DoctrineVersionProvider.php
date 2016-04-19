<?php
namespace MigrationBundle\Migration;

use Doctrine\Common\Persistence\ObjectManager;
use Migration\VersionProviderInterface;

class DoctrineVersionProvider implements VersionProviderInterface
{
    private $om;
    private $versionClass;

    public function __construct(ObjectManager $om, $versionClass)
    {
        $this->om = $om;
        $this->versionClass = $versionClass;
    }

    /**
     * @param $version
     *
     * @return bool
     */
    public function hasVersion($version)
    {
        return !!$this->om->getRepository($this->versionClass)->findOneBy(array('name' => $version));
    }

    /**
     * @param $version
     */
    public function addVersion($version)
    {
        $versionRef = new \ReflectionClass($this->versionClass);
        $version = $versionRef->newInstance(array($version));

        $this->om->persist($version);
        $this->om->flush();
    }
}