<?php

namespace Projects\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table(name="projects")
 * @ORM\Entity
 */
class Projects
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=true, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="developer", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $developer;
    
    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $logo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $address;


    /**
     * @var string
     *
     * @ORM\Column(name="internal_amenities", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $internalAmenities;

    /**
     * @var string
     *
     * @ORM\Column(name="external_amenities", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $externalAmenities;


    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;

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
     * @return Projects
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
     * Set developer
     *
     * @param string $developer
     *
     * @return Projects
     */
    public function setDeveloper($developer)
    {
        $this->developer = $developer;

        return $this;
    }

    /**
     * Get developer
     *
     * @return string
     */
    public function getDeveloper()
    {
        return $this->developer;
    }
    
    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Settings
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
    
    /**
     * Set city
     *
     * @param string $city
     *
     * @return Projects
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Projects
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
    * Set internalAmenities
    *
    * @param string $internalAmenities
    *
    * @return Projects
    */
    public function setInternalAmenities($internalAmenities)
    {
        $this->internalAmenities = $internalAmenities;

        return $this;
    }

    /**
     * Get internalAmenities
     *
     * @return string
     */
    public function getInternalAmenities()
    {
        return $this->internalAmenities;
    }

    /**
     * Set externalAmenities
     *
     * @param string $externalAmenities
     *
     * @return Projects
     */
    public function setExternalAmenities($externalAmenities)
    {
        $this->externalAmenities = $externalAmenities;

        return $this;
    }

    /**
     * Get externalAmenities
     *
     * @return string
     */
    public function getExternalAmenities()
    {
        return $this->externalAmenities;
    }

    /**
    * Set status
    *
    * @param integer $status
    *
    * @return Projects
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
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Projects
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
     * @return Projects
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
        return $this->dateCreated;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
    }
}
