<?php


namespace Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdRoleWindows
 *
 * @Table(name="ad_role_windows")
 * @Entity
 */
class AdRoleWindows
{
    /**
     * @var bigint $adRoleWindowsId
     *
     * @Column(name="AD_Role_Windows_ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $adRoleWindowsId;

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
     * @var Entities\AdWindow
     *
     * @ManyToOne(targetEntity="AdWindow")
     * @JoinColumns({
     *   @JoinColumn(name="AD_Window_ID", referencedColumnName="AD_Window_ID")
     * })
     */
    private $adWindow;

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
     * Get adRoleWindowsId
     *
     * @return bigint 
     */
    public function getAdRoleWindowsId()
    {
        return $this->adRoleWindowsId;
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
    public function setUpdatedby(Entities\AdUser $updatedby)
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
     * Set adWindow
     *
     * @param AdWindow $adWindow
     */
    public function setAdWindow(Entities\AdWindow $adWindow)
    {
        $this->adWindow = $adWindow;
    }

    /**
     * Get adWindow
     *
     * @return AdWindow 
     */
    public function getAdWindow()
    {
        return $this->adWindow;
    }

    /**
     * Set createdby
     *
     * @param AdUser $createdby
     */
    public function setCreatedby(Entities\AdUser $createdby)
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