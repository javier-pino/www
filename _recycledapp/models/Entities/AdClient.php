<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * AdClient
 *
 * @Table(name="ad_client")
 * @Entity
 */
class AdClient
{
    /**
     * @var bigint $adClientId
     *
     * @Column(name="AD_Client_ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $adClientId;

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
     * @var string $requestemail
     *
     * @Column(name="RequestEMail", type="string", length=60, nullable=true)
     */
    private $requestemail;

    /**
     * @var string $requestuser
     *
     * @Column(name="RequestUser", type="string", length=60, nullable=true)
     */
    private $requestuser;

    /**
     * @var string $requestfolder
     *
     * @Column(name="RequestFolder", type="string", length=20, nullable=true)
     */
    private $requestfolder;

    /**
     * @var string $documentdir
     *
     * @Column(name="DocumentDir", type="string", length=60, nullable=true)
     */
    private $documentdir;



    /**
     * Get adClientId
     *
     * @return bigint 
     */
    public function getAdClientId()
    {
        return $this->adClientId;
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
     * Set requestemail
     *
     * @param string $requestemail
     */
    public function setRequestemail($requestemail)
    {
        $this->requestemail = $requestemail;
    }

    /**
     * Get requestemail
     *
     * @return string 
     */
    public function getRequestemail()
    {
        return $this->requestemail;
    }

    /**
     * Set requestuser
     *
     * @param string $requestuser
     */
    public function setRequestuser($requestuser)
    {
        $this->requestuser = $requestuser;
    }

    /**
     * Get requestuser
     *
     * @return string 
     */
    public function getRequestuser()
    {
        return $this->requestuser;
    }

    /**
     * Set requestfolder
     *
     * @param string $requestfolder
     */
    public function setRequestfolder($requestfolder)
    {
        $this->requestfolder = $requestfolder;
    }

    /**
     * Get requestfolder
     *
     * @return string 
     */
    public function getRequestfolder()
    {
        return $this->requestfolder;
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
}