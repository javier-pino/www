<?php


namespace Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdUser
 *
 * @Table(name="ad_user")
 * @Entity
 */
class AdUser
{
    /**
     * @var bigint $adUserId
     *
     * @Column(name="AD_User_ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $adUserId;

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
     * @var string $login
     *
     * @Column(name="Login", type="string", length=60, nullable=false)
     */
    private $login;

    /**
     * @var string $name
     *
     * @Column(name="Name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var text $description
     *
     * @Column(name="Description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var text $comments
     *
     * @Column(name="Comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var text $password
     *
     * @Column(name="Password", type="text", nullable=false)
     */
    private $password;

    /**
     * @var text $email
     *
     * @Column(name="Email", type="text", nullable=true)
     */
    private $email;

    /**
     * @var string $phone
     *
     * @Column(name="Phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string $phone2
     *
     * @Column(name="Phone2", type="string", length=45, nullable=true)
     */
    private $phone2;

    /**
     * @var date $birthday
     *
     * @Column(name="Birthday", type="date", nullable=true)
     */
    private $birthday;

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
     * @var Entities\AdUser
     *
     * @ManyToOne(targetEntity="AdUser")
     * @JoinColumns({
     *   @JoinColumn(name="Supervisor_ID", referencedColumnName="AD_User_ID")
     * })
     */
    private $supervisor;

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
     * Get adUserId
     *
     * @return bigint 
     */
    public function getAdUserId()
    {
        return $this->adUserId;
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
     * Set login
     *
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
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
     * Set comments
     *
     * @param text $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * Get comments
     *
     * @return text 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set password
     *
     * @param text $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return text 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param text $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return text 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    /**
     * Get phone2
     *
     * @return string 
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set birthday
     *
     * @param date $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Get birthday
     *
     * @return date 
     */
    public function getBirthday()
    {
        return $this->birthday;
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
     * Set supervisor
     *
     * @param AdUser $supervisor
     */
    public function setSupervisor(Entities\AdUser $supervisor)
    {
        $this->supervisor = $supervisor;
    }

    /**
     * Get supervisor
     *
     * @return AdUser 
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Set createdby
     *
     * @param Entities\AdUser $createdby
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