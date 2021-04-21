<?php

namespace Leads\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LeadOwners
 *
 * @ORM\Table(name="lead_owners")
 * @ORM\Entity
 */
class LeadOwners
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
     * @var integer
     *
     * @ORM\Column(name="owner", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $owner;

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
     * Set leadId
     *
     * @param integer $leadId
     *
     * @return LeadOwners
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
     * Set owner
     *
     * @param integer $owner
     *
     * @return LeadOwners
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return integer
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return LeadOwners
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
