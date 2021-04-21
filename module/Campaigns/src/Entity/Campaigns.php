<?php

namespace Campaigns\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campaigns
 *
 * @ORM\Table(name="campaigns")
 * @ORM\Entity
 */
class Campaigns
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $campaignName;

    /**
     * @var string
     *
     * @ORM\Column(name="total_budget", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $totalBudget;

    /**
     * @var string
     *
     * @ORM\Column(name="total_spent", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $totalSpent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $toDate;

    /**
     * @var string
     *
     * @ORM\Column(name="virtual_number", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $virtualNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_type", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $campaignType;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_description", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $campaignDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateCreated;

    
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set campaignName
     *
     * @param string $campaignName
     *
     * @return Campaigns
     */
    public function setCampaignName($campaignName)
    {
        $this->campaignName = $campaignName;

        return $this;
    }

    /**
     * Get campaignName
     *
     * @return string
     */
    public function getCampaignName()
    {
        return $this->campaignName;
    }

    /**
     * Set totalBudget
     *
     * @param string $totalBudget
     *
     * @return Campaigns
     */
    public function setTotalBudget($totalBudget)
    {
        $this->totalBudget = $totalBudget;

        return $this;
    }

    /**
     * Get totalBudget
     *
     * @return string
     */
    public function getTotalBudget()
    {
        return $this->totalBudget;
    }

    /**
     * Set totalSpent
     *
     * @param string $totalSpent
     *
     * @return Campaigns
     */
    public function setTotalSpent($totalSpent)
    {
        $this->totalSpent = $totalSpent;

        return $this;
    }

    /**
     * Get totalSpent
     *
     * @return string
     */
    public function getTotalSpent()
    {
        return $this->totalSpent;
    }

    /**
     * Set fromDate
     *
     * @param \DateTime $fromDate
     *
     * @return Campaigns
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return (!empty($this->fromDate)? $this->fromDate->format('d-m-Y'):'');
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     *
     * @return Campaigns
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime
     */
    public function getToDate()
    {
        return (!empty($this->toDate)? $this->toDate->format('d-m-Y'):'');
    }

    /**
     * Set virtualNumber
     *
     * @param string $virtualNumber
     *
     * @return Campaigns
     */
    public function setVirtualNumber($virtualNumber)
    {
        $this->virtualNumber = $virtualNumber;

        return $this;
    }

    /**
     * Get virtualNumber
     *
     * @return string
     */
    public function getVirtualNumber()
    {
        return $this->virtualNumber;
    }

    /**
     * Set campaignType
     *
     * @param string $campaignType
     *
     * @return Campaigns
     */
    public function setCampaignType($campaignType)
    {
        $this->campaignType = $campaignType;

        return $this;
    }

    /**
     * Get campaignType
     *
     * @return string
     */
    public function getCampaignType()
    {
        return $this->campaignType;
    }


    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Campaigns
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set campaignDescription
     *
     * @param string $campaignDescription
     *
     * @return Campaigns
     */
    public function setCampaignDescription($campaignDescription)
    {
        $this->campaignDescription = $campaignDescription;

        return $this;
    }

    /**
     * Get campaignDescription
     *
     * @return string
     */
    public function getCampaignDescription()
    {
        return $this->campaignDescription;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Campaigns
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Campaigns
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated->format('d-m-Y');
    }
}
