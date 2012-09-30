<?php


namespace Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdClientinfo
 *
 * @Table(name="ad_clientinfo")
 * @Entity
 */
class AdClientinfo
{
    /**
     * @var bigint $adClientinfoId
     *
     * @Column(name="AD_ClientInfo_ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $adClientinfoId;

    /**
     * @var bigint $cAcctschema1Id
     *
     * @Column(name="C_AcctSchema1_ID", type="bigint", nullable=true)
     */
    private $cAcctschema1Id;

    /**
     * @var bigint $cAcctschema2Id
     *
     * @Column(name="C_AcctSchema2_ID", type="bigint", nullable=true)
     */
    private $cAcctschema2Id;

    /**
     * @var bigint $cAcctschema3Id
     *
     * @Column(name="C_AcctSchema3_ID", type="bigint", nullable=true)
     */
    private $cAcctschema3Id;

    /**
     * @var bigint $mPricelistId
     *
     * @Column(name="M_PriceList_ID", type="bigint", nullable=true)
     */
    private $mPricelistId;

    /**
     * @var integer $keeplogdays
     *
     * @Column(name="KeepLogDays", type="integer", nullable=false)
     */
    private $keeplogdays;

    /**
     * @var Entities\AdClient
     *
     * @ManyToOne(targetEntity="AdClient")
     * @JoinColumns({
     *   @JoinColumn(name="AD_Client_ID", referencedColumnName="AD_Client_ID")
     * })
     */
    private $adClient;



    /**
     * Get adClientinfoId
     *
     * @return bigint 
     */
    public function getAdClientinfoId()
    {
        return $this->adClientinfoId;
    }

    /**
     * Set cAcctschema1Id
     *
     * @param bigint $cAcctschema1Id
     */
    public function setCAcctschema1Id($cAcctschema1Id)
    {
        $this->cAcctschema1Id = $cAcctschema1Id;
    }

    /**
     * Get cAcctschema1Id
     *
     * @return bigint 
     */
    public function getCAcctschema1Id()
    {
        return $this->cAcctschema1Id;
    }

    /**
     * Set cAcctschema2Id
     *
     * @param bigint $cAcctschema2Id
     */
    public function setCAcctschema2Id($cAcctschema2Id)
    {
        $this->cAcctschema2Id = $cAcctschema2Id;
    }

    /**
     * Get cAcctschema2Id
     *
     * @return bigint 
     */
    public function getCAcctschema2Id()
    {
        return $this->cAcctschema2Id;
    }

    /**
     * Set cAcctschema3Id
     *
     * @param bigint $cAcctschema3Id
     */
    public function setCAcctschema3Id($cAcctschema3Id)
    {
        $this->cAcctschema3Id = $cAcctschema3Id;
    }

    /**
     * Get cAcctschema3Id
     *
     * @return bigint 
     */
    public function getCAcctschema3Id()
    {
        return $this->cAcctschema3Id;
    }

    /**
     * Set mPricelistId
     *
     * @param bigint $mPricelistId
     */
    public function setMPricelistId($mPricelistId)
    {
        $this->mPricelistId = $mPricelistId;
    }

    /**
     * Get mPricelistId
     *
     * @return bigint 
     */
    public function getMPricelistId()
    {
        return $this->mPricelistId;
    }

    /**
     * Set keeplogdays
     *
     * @param integer $keeplogdays
     */
    public function setKeeplogdays($keeplogdays)
    {
        $this->keeplogdays = $keeplogdays;
    }

    /**
     * Get keeplogdays
     *
     * @return integer 
     */
    public function getKeeplogdays()
    {
        return $this->keeplogdays;
    }

    /**
     * Set adClient
     *
     * @param AdClient $adClient
     */
    public function setAdClient(Entities\AdClient $adClient)
    {
        $this->adClient = $adClient;
    }

    /**
     * Get adClient
     *
     * @return AdClient 
     */
    public function getAdClient()
    {
        return $this->adClient;
    }
}