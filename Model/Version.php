<?php
namespace MigrationBundle\Document;

abstract class Version
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $migratedAt;

    public function __construct($name)
    {
        $this->name = $name;
        $this->migratedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \DateTime
     */
    public function getMigratedAt()
    {
        return $this->migratedAt;
    }

}
