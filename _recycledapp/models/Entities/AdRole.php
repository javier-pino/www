<?php


namespace Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdRole
 *
 * @Table(name="ad_role")
 * @Entity
 */
class AdRole
{
    /**
     * @var bigint $adRoleId
     *
     * @Column(name="AD_Role_ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $adRoleId;

    /**
     * @var string $finder
     *
     * @Column(name="Finder", type="string", length=60, nullable=false)
     */
    private $finder;

    /**
     * @var string $name
     *
     * @Column(name="Name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var text $description
     *
     * @Column(name="Description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var bigint $adTreeMenuId
     *
     * @Column(name="AD_Tree_Menu_ID", type="bigint", nullable=true)
     */
    private $adTreeMenuId;

    /**
     * @var datetime $created
     *
     * @Column(name="Created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var bigint $createdby
     *
     * @Column(name="CreatedBy", type="bigint", nullable=true)
     */
    private $createdby;

    /**
     * @var datetime $updated
     *
     * @Column(name="Updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var bigint $updatedby
     *
     * @Column(name="UpdatedBy", type="bigint", nullable=true)
     */
    private $updatedby;



    /**
     * Get adRoleId
     *
     * @return bigint 
     */
    public function getAdRoleId()
    {
        return $this->adRoleId;
    }

    /**
     * Set finder
     *
     * @param string $finder
     */
    public function setFinder($finder)
    {
        $this->finder = $finder;
    }

    /**
     * Get finder
     *
     * @return string 
     */
    public function getFinder()
    {
        return $this->finder;
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
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set adTreeMenuId
     *
     * @param bigint $adTreeMenuId
     */
    public function setAdTreeMenuId($adTreeMenuId)
    {
        $this->adTreeMenuId = $adTreeMenuId;
    }

    /**
     * Get adTreeMenuId
     *
     * @return bigint 
     */
    public function getAdTreeMenuId()
    {
        return $this->adTreeMenuId;
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set createdby
     *
     * @param bigint $createdby
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;
    }

    /**
     * Get createdby
     *
     * @return bigint 
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updatedby
     *
     * @param bigint $updatedby
     */
    public function setUpdatedby($updatedby)
    {
        $this->updatedby = $updatedby;
    }

    /**
     * Get updatedby
     *
     * @return bigint 
     */
    public function getUpdatedby()
    {
        return $this->updatedby;
    }
}