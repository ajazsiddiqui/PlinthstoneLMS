<?php

namespace Followups\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Followups
 *
 * @ORM\Table(name="followups")
 * @ORM\Entity
 */
class Followups
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
     * @var integer
     *
     * @ORM\Column(name="lead_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $leadId;

    /**
     * @var string
     *
     * @ORM\Column(name="followup_type", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $followupType;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="follow_date", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $followDate;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarks;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", precision=0, scale=0, nullable=true, unique=false)
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
     * Set leadId
     *
     * @param integer $leadId
     *
     * @return Followups
     */
    public function setLeadId($leadId)
    {
        $this->leadId = $leadId;

        return $this;
    }

    /**
     * Get leadId
     *
     * @return integer
     */
    public function getLeadId()
    {
        return $this->leadId;
    }

    /**
     * Set followupType
     *
     * @param string $followupType
     *
     * @return Followups
     */
    public function setFollowupType($followupType)
    {
        $this->followupType = $followupType;

        return $this;
    }

    /**
     * Get followupType
     *
     * @return string
     */
    public function getFollowupType()
    {
        return $this->followupType;
    }


    /**
     * Set followDate
     *
     * @param \DateTime $followDate
     *
     * @return Followups
     */
    public function setFollowDate($followDate)
    {
        $this->followDate = $followDate;
        return $this;
    }

    /**
     * Get followDate
     *
     * @return \DateTime
     */
    public function getFollowDate()
    {
        return (!empty($this->followDate)? $this->followDate->format('d-m-Y'):'');
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Followups
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Followups
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string
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
     * @return Followups
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
