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
     * @var Entities\ADRole
     *
     * @ManyToOne(targetEntity="AdRole")
     * @JoinColumns({
     *   @JoinColumn(name="AD_Role_ID", referencedColumnName="AD_Role_ID")
     * })
     */
    private $adRole;

    /**
     * @var Entities\ADWindow
     *
     * @ManyToOne(targetEntity="AdWindow")
     * @JoinColumns({
     *   @JoinColumn(name="AD_Window_ID", referencedColumnName="AD_Window_ID")
     * })
     */
    private $adWindow;



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
     * Set adWindow
     *
     * @param AdWindow $adWindow
     */
    public function setAdWindow(Entities\ADWindow $adWindow)
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
}