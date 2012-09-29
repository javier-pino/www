<?php


namespace Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdWindow
 *
 * @Table(name="ad_window")
 * @Entity
 */
class AdWindow
{
    /**
     * @var bigint $adWindowId
     *
     * @Column(name="AD_Window_ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $adWindowId;

    /**
     * @var string $name
     *
     * @Column(name="Name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string $module
     *
     * @Column(name="Module", type="string", length=60, nullable=false)
     */
    private $module;

    /**
     * @var string $documentdir
     *
     * @Column(name="DocumentDir", type="string", length=60, nullable=true)
     */
    private $documentdir;

    /**
     * @var string $class
     *
     * @Column(name="Class", type="string", length=10, nullable=false)
     */
    private $class;



    /**
     * Get adWindowId
     *
     * @return bigint 
     */
    public function getAdWindowId()
    {
        return $this->adWindowId;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set module
     *
     * @param string $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set documentdir
     *
     * @param string $documentdir
     */
    public function setDocumentdir($documentdir)
    {
        $this->documentdir = $documentdir;
    }

    /**
     * Get documentdir
     *
     * @return string 
     */
    public function getDocumentdir()
    {
        return $this->documentdir;
    }

    /**
     * Set class
     *
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }
}