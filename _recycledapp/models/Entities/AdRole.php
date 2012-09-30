<?php



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
     * @var datetime $updated
     *
     * @Column(name="Updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var AdUser
     *
     * @ManyToOne(targetEntity="AdUser")
     * @JoinColumns({
     *   @JoinColumn(name="UpdatedBy", referencedColumnName="AD_User_ID")
     * })
     */
    private $updatedby;

    /**
     * @var AdUser
     *
     * @ManyToOne(targetEntity="AdUser")
     * @JoinColumns({
     *   @JoinColumn(name="CreatedBy", referencedColumnName="AD_User_ID")
     * })
     */
    private $createdby;



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
     * @param AdUser $updatedby
     */
    public function setUpdatedby(\AdUser $updatedby)
    {
        $this->updatedby = $updatedby;
    }

    /**
     * Get updatedby
     *
     * @return AdUser 
     */
    public function getUpdatedby()
    {
        return $this->updatedby;
    }

    /**
     * Set createdby
     *
     * @param AdUser $createdby
     */
    public function setCreatedby(\AdUser $createdby)
    {
        $this->createdby = $createdby;
    }

    /**
     * Get createdby
     *
     * @return AdUser 
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }
}