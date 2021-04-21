<?php

namespace Telephony\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telephony
 *
 * @ORM\Table(name="telephony")
 * @ORM\Entity
 */
class Telephony
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
     * @ORM\Column(name="call_id", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $callId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lead_id", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $leadId;

    /**
     * @var string
     *
     * @ORM\Column(name="caller_number", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $callerNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="start_time", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $startTime;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="event", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="reciever", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $reciever;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $action;

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
     * Set callId
     *
     * @param string $callId
     *
     * @return Telephony
     */
    public function setCallId($callId)
    {
        $this->callId = $callId;

        return $this;
    }

    /**
     * Get callId
     *
     * @return string
     */
    public function getCallId()
    {
        return $this->callId;
    }
    
    /**
     * Set leadId
     *
     * @param string $leadId
     *
     * @return Telephony
     */
    public function setLeadId($leadId)
    {
        $this->leadId = $leadId;

        return $this;
    }

    /**
     * Get leadId
     *
     * @return string
     */
    public function getLeadId()
    {
        return $this->leadId;
    }

    /**
     * Set callerNumber
     *
     * @param string $callerNumber
     *
     * @return Telephony
     */
    public function setCallerNumber($callerNumber)
    {
        $this->callerNumber = $callerNumber;

        return $this;
    }

    /**
     * Get callerNumber
     *
     * @return string
     */
    public function getCallerNumber()
    {
        return $this->callerNumber;
    }

    /**
     * Set startTime
     *
     * @param string $startTime
     *
     * @return Telephony
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Telephony
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set event
     *
     * @param integer $event
     *
     * @return Telephony
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return integer
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Telephony
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set reciever
     *
     * @param string $reciever
     *
     * @return Telephony
     */
    public function setReciever($reciever)
    {
        $this->reciever = $reciever;

        return $this;
    }

    /**
     * Get reciever
     *
     * @return string
     */
    public function getReciever()
    {
        return $this->reciever;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return Telephony
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Telephony
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
        return $this->dateCreated->format('d-m-Y H:i:s');
    }
}
