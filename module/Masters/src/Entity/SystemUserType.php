<?php

namespace Masters\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SystemUserType
 *
 * @ORM\Table(name="system_user_type")
 * @ORM\Entity
 */
class SystemUserType
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
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="negotiation_percent", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $negotiationPercent;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_mask", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $numberMask;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="eod_status", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $eodStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="confidential", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $confidential;

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
     * Set name
     *
     * @param string $name
     *
     * @return SystemUserType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set negotiationPercent
     *
     * @param float $negotiationPercent
     *
     * @return SystemUserType
     */
    public function setNegotiationPercent($negotiationPercent)
    {
        $this->negotiationPercent = $negotiationPercent;

        return $this;
    }

    /**
     * Get negotiationPercent
     *
     * @return float
     */
    public function getNegotiationPercent()
    {
        return $this->negotiationPercent;
    }

    /**
     * Set numberMask
     *
     * @param integer $numberMask
     *
     * @return SystemUserType
     */
    public function setNumberMask($numberMask)
    {
        $this->numberMask = $numberMask;

        return $this;
    }

    /**
     * Get numberMask
     *
     * @return integer
     */
    public function getNumberMask()
    {
        return $this->numberMask;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return SystemUserType
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set eodStatus
     *
     * @param integer $eodStatus
     *
     * @return SystemUserType
     */
    public function setEodStatus($eodStatus)
    {
        $this->eodStatus = $eodStatus;

        return $this;
    }

    /**
     * Get eodStatus
     *
     * @return integer
     */
    public function getEodStatus()
    {
        return $this->eodStatus;
    }

    /**
     * Set confidential
     *
     * @param integer $confidential
     *
     * @return SystemUserType
     */
    public function setConfidential($confidential)
    {
        $this->confidential = $confidential;

        return $this;
    }

    /**
     * Get confidential
     *
     * @return integer
     */
    public function getConfidential()
    {
        return $this->confidential;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return SystemUserType
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
     * @return SystemUserType
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
        return $this->dateCreated->format('Y-m-d H:i:s');
    }
}
