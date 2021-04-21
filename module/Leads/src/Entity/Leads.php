<?php

namespace Leads\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leads
 *
 * @ORM\Table(name="leads")
 * @ORM\Entity
 */
class Leads
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $contact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $state;

    /**
     * @var int|null
     *
     * @ORM\Column(name="location", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $location;

    /**
     * @var string|null
     *
     * @ORM\Column(name="configuration", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $configuration;

    /**
     * @var int|null
     *
     * @ORM\Column(name="project", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $project;

    /**
     * @var int|null
     *
     * @ORM\Column(name="campaign", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $campaign;

    /**
     * @var int|null
     *
     * @ORM\Column(name="source", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $source;
    
    /**
     * @var int|null
     *
     * @ORM\Column(name="junk", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $junk;
    
    /**
     * @var int|null
     *
     * @ORM\Column(name="visited", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $visited;

    /**
     * @var int|null
     *
     * @ORM\Column(name="interested", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $interested;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remarks", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarks;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $status;
    
    /**
     * @var int|null
     *
     * @ORM\Column(name="closed", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $closed;

    /**
     * @var string|null
     *
     * @ORM\Column(name="created_by", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_created", type="datetime", precision=0, scale=0, nullable=true, options={"default"="CURRENT_TIMESTAMP"}, unique=false)
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Leads
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string|null $lastName
     *
     * @return Leads
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set contact.
     *
     * @param string|null $contact
     *
     * @return Leads
     */
    public function setContact($contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return string|null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Leads
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Leads
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state.
     *
     * @param string|null $state
     *
     * @return Leads
     */
    public function setState($state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set location.
     *
     * @param int|null $location
     *
     * @return Leads
     */
    public function setLocation($location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location.
     *
     * @return int|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set configuration.
     *
     * @param string|null $configuration
     *
     * @return Leads
     */
    public function setConfiguration($configuration = null)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * Get configuration.
     *
     * @return string|null
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Set project.
     *
     * @param int|null $project
     *
     * @return Leads
     */
    public function setProject($project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project.
     *
     * @return int|null
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set campaign.
     *
     * @param int|null $campaign
     *
     * @return Leads
     */
    public function setCampaign($campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign.
     *
     * @return int|null
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Set source.
     *
     * @param int|null $source
     *
     * @return Leads
     */
    public function setSource($source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source.
     *
     * @return int|null
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set interested.
     *
     * @param int|null $interested
     *
     * @return Leads
     */
    public function setInterested($interested = null)
    {
        $this->interested = $interested;

        return $this;
    }

    /**
     * Get interested.
     *
     * @return int|null
     */
    public function getInterested()
    {
        return $this->interested;
    }

    /**
     * Set remarks.
     *
     * @param string|null $remarks
     *
     * @return Leads
     */
    public function setRemarks($remarks = null)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks.
     *
     * @return string|null
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set status.
     *
     * @param string|null $status
     *
     * @return Leads
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    
    /**
     * Set junk.
     *
     * @param string|null $status
     *
     * @return Leads
     */
    public function setJunk($junk = null)
    {
        $this->junk = $junk;

        return $this;
    }

    /**
     * Get junk.
     *
     * @return string|null
     */
    public function getJunk()
    {
        return $this->junk;
    }
    
    /**
     * Set visited.
     *
     * @param string|null $visited
     *
     * @return Leads
     */
    public function setVisited($visited = null)
    {
        $this->visited = $visited;

        return $this;
    }

    /**
     * Get visited.
     *
     * @return string|null
     */
    public function getVisited()
    {
        return $this->visited;
    }

    /**
     * Set closed.
     *
     * @param string|null $closed
     *
     * @return Leads
     */
    public function setClosed($closed = null)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed.
     *
     * @return string|null
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set createdBy.
     *
     * @param string|null $createdBy
     *
     * @return Leads
     */
    public function setCreatedBy($createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy.
     *
     * @return string|null
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set dateCreated.
     *
     * @param \DateTime|null $dateCreated
     *
     * @return Leads
     */
    public function setDateCreated($dateCreated = null)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated.
     *
     * @return \DateTime|null
     */
    public function getDateCreated()
    {
        return $this->dateCreated->format('d-m-Y');
    }
}
