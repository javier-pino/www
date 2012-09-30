<?php


namespace Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdUserRoles
 *
 * @Table(name="ad_user_roles")
 * @Entity
 */
class AdUserRoles
{
    /**
     * @var bigint $adUserrolesId
     *
     * @Column(name="AD_UserRoles_ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $adUserrolesId;

    /**
     * @var datetime $created
     *
     * @Column(name="Created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var bigint $createdby
     *
     * @Column(name="CreatedBy", type="bigint", nullable=false)
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
     * @var Entities\AdRole
     *
     * @ManyToOne(targetEntity="AdRole")
     * @JoinColumns({
     *   @JoinColumn(name="AD_Role_ID", referencedColumnName="AD_Role_ID")
     * })
     */
    private $adRole;

    /**
     * @var Entities\AdUser
     *
     * @ManyToOne(targetEntity="AdUser")
     * @JoinColumns({
     *   @JoinColumn(name="AD_User_ID", referencedColumnName="AD_User_ID")
     * })
     */
    private $adUser;



    /**
     * Get adUserrolesId
     *
     * @return bigint 
     */
    public function getAdUserrolesId()
    {
        return $this->adUserrolesId;
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

    /**
     * Set adRole
     *
     * @param AdRole $adRole
     */
    public function setAdRole(Entities\AdRole $adRole)
    {
        $this->adRole = $adRole;
    }

    /**
     * Get adRole
     *
     * @return AdRole 
     */
    public function getAdRole()
    {
        return $this->adRole;
    }

    /**
     * Set adUser
     *
     * @param AdUser $adUser
     */
    public function setAdUser(Entities\AdUser $adUser)
    {
        $this->adUser = $adUser;
    }

    /**
     * Get adUser
     *
     * @return AdUser 
     */
    public function getAdUser()
    {
        return $this->adUser;
    }
}