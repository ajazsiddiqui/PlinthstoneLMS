<?php

namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity
 */
class Settings
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
     * @ORM\Column(name="company_name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $companyName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="company_brief", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $companyBrief;
    
    /**
     * @var string
     *
     * @ORM\Column(name="company_logo", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $companyLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="favicon", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $favicon;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_color", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $brandColor;

    /**
     * @var integer
     *
     * @ORM\Column(name="cp_approval", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $cpApproval;

    /**
     * @var string
     *
     * @ORM\Column(name="page_title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="name_emailer", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nameEmailer;

    /**
     * @var string
     *
     * @ORM\Column(name="email_emailer", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $emailEmailer;

    /**
     * @var string
     *
     * @ORM\Column(name="birthday_reminder", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $birthdayReminder;

    /**
     * @var integer
     *
     * @ORM\Column(name="sms_enabled", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $smsEnabled;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_api", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $smsApi;

    /**
     * @var string
     *
     * @ORM\Column(name="kookoo_api", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $kookooApi;

    /**
     * @var string
     *
     * @ORM\Column(name="call_api", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $callApi;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Settings
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }
    
    /**
     * Set companyBrief
     *
     * @param string $companyBrief
     *
     * @return Settings
     */
    public function setCompanyBrief($companyBrief)
    {
        $this->companyBrief = $companyBrief;

        return $this;
    }

    /**
     * Get companyBrief
     *
     * @return string
     */
    public function getCompanyBrief()
    {
        return $this->companyBrief;
    }
    
    /**
     * Set companyLogo
     *
     * @param string $companyLogo
     *
     * @return Settings
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo;

        return $this;
    }

    /**
     * Get companyLogo
     *
     * @return string
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     * Set favicon
     *
     * @param string $favicon
     *
     * @return Settings
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;

        return $this;
    }

    /**
     * Get favicon
     *
     * @return string
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * Set brandColor
     *
     * @param string $brandColor
     *
     * @return Settings
     */
    public function setBrandColor($brandColor)
    {
        $this->brandColor = $brandColor;

        return $this;
    }

    /**
     * Get brandColor
     *
     * @return string
     */
    public function getBrandColor()
    {
        return $this->brandColor;
    }

    /**
     * Set cpApproval
     *
     * @param integer $cpApproval
     *
     * @return Settings
     */
    public function setCpApproval($cpApproval)
    {
        $this->cpApproval = $cpApproval;

        return $this;
    }

    /**
     * Get cpApproval
     *
     * @return integer
     */
    public function getCpApproval()
    {
        return $this->cpApproval;
    }

    /**
     * Set pageTitle
     *
     * @param string $pageTitle
     *
     * @return Settings
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set nameEmailer
     *
     * @param string $nameEmailer
     *
     * @return Settings
     */
    public function setNameEmailer($nameEmailer)
    {
        $this->nameEmailer = $nameEmailer;

        return $this;
    }

    /**
     * Get nameEmailer
     *
     * @return string
     */
    public function getNameEmailer()
    {
        return $this->nameEmailer;
    }

    /**
     * Set emailEmailer
     *
     * @param string $emailEmailer
     *
     * @return Settings
     */
    public function setEmailEmailer($emailEmailer)
    {
        $this->emailEmailer = $emailEmailer;

        return $this;
    }

    /**
     * Get emailEmailer
     *
     * @return string
     */
    public function getEmailEmailer()
    {
        return $this->emailEmailer;
    }

    /**
     * Set birthdayReminder
     *
     * @param string $birthdayReminder
     *
     * @return Settings
     */
    public function setBirthdayReminder($birthdayReminder)
    {
        $this->birthdayReminder = $birthdayReminder;

        return $this;
    }

    /**
     * Get birthdayReminder
     *
     * @return string
     */
    public function getBirthdayReminder()
    {
        return $this->birthdayReminder;
    }

    /**
     * Set smsEnabled
     *
     * @param integer $smsEnabled
     *
     * @return Settings
     */
    public function setSmsEnabled($smsEnabled)
    {
        $this->smsEnabled = $smsEnabled;

        return $this;
    }

    /**
     * Get smsEnabled
     *
     * @return integer
     */
    public function getSmsEnabled()
    {
        return $this->smsEnabled;
    }

    /**
     * Set smsApi
     *
     * @param string $smsApi
     *
     * @return Settings
     */
    public function setSmsApi($smsApi)
    {
        $this->smsApi = $smsApi;

        return $this;
    }

    /**
     * Get smsApi
     *
     * @return string
     */
    public function getSmsApi()
    {
        return $this->smsApi;
    }

    /**
     * Set kookooApi
     *
     * @param string $kookooApi
     *
     * @return Settings
     */
    public function setKookooApi($kookooApi)
    {
        $this->kookooApi = $kookooApi;

        return $this;
    }

    /**
     * Get kookooApi
     *
     * @return string
     */
    public function getKookooApi()
    {
        return $this->kookooApi;
    }

    /**
     * Set callApi
     *
     * @param string $callApi
     *
     * @return Settings
     */
    public function setCallApi($callApi)
    {
        $this->callApi = $callApi;

        return $this;
    }

    /**
     * Get callApi
     *
     * @return string
     */
    public function getCallApi()
    {
        return $this->callApi;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Settings
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
     * @return Settings
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
}
