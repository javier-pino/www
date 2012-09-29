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
     * @var datetime $updated
     *
     * @Column(name="Updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var Entities\AdUser
     *
     * @ManyToOne(targetEntity="AdUser")
     * @JoinColumns({
     *   @JoinColumn(name="UpdatedBy", referencedColumnName="AD_User_ID")
     * })
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
     * @var Entities\AdUser
     *
     * @ManyToOne(targetEntity="AdUser")
     * @JoinColumns({
     *   @JoinColumn(name="CreatedBy", referencedColumnName="AD_User_ID")
     * })
     */
    private $createdby;



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
    public function setUpdatedby(Entities\ADUser $updatedby)
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
     * Set adRole
     *
     * @param AdRole $adRole
     */
    public function setAdRole(Entities\ADRole $adRole)
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
    public function setAdUser(Entities\ADUser $adUser)
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

    /**
     * Set createdby
     *
     * @param AdUser $createdby
     */
    public function setCreatedby(Entities\ADUser $createdby)
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