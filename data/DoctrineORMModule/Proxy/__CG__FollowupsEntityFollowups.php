<?php

namespace DoctrineORMModule\Proxy\__CG__\Followups\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Followups extends \Followups\Entity\Followups implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'id', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'leadId', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'touchPoint', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'action', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'actionDate', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'sitevisitWith', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'sitevisitMembers', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'telephonicNewdate', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'remark', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'createdBy', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'dateCreated'];
        }

        return ['__isInitialized__', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'id', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'leadId', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'touchPoint', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'action', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'actionDate', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'sitevisitWith', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'sitevisitMembers', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'telephonicNewdate', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'remark', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'createdBy', '' . "\0" . 'Followups\\Entity\\Followups' . "\0" . 'dateCreated'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Followups $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setLeadId($leadId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLeadId', [$leadId]);

        return parent::setLeadId($leadId);
    }

    /**
     * {@inheritDoc}
     */
    public function getLeadId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLeadId', []);

        return parent::getLeadId();
    }

    /**
     * {@inheritDoc}
     */
    public function setTouchPoint($touchPoint)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTouchPoint', [$touchPoint]);

        return parent::setTouchPoint($touchPoint);
    }

    /**
     * {@inheritDoc}
     */
    public function getTouchPoint()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTouchPoint', []);

        return parent::getTouchPoint();
    }

    /**
     * {@inheritDoc}
     */
    public function setAction($action)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAction', [$action]);

        return parent::setAction($action);
    }

    /**
     * {@inheritDoc}
     */
    public function getAction()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAction', []);

        return parent::getAction();
    }

    /**
     * {@inheritDoc}
     */
    public function setActionDate($actionDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setActionDate', [$actionDate]);

        return parent::setActionDate($actionDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getActionDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getActionDate', []);

        return parent::getActionDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setSitevisitWith($sitevisitWith)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSitevisitWith', [$sitevisitWith]);

        return parent::setSitevisitWith($sitevisitWith);
    }

    /**
     * {@inheritDoc}
     */
    public function getSitevisitWith()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSitevisitWith', []);

        return parent::getSitevisitWith();
    }

    /**
     * {@inheritDoc}
     */
    public function setSitevisitMembers($sitevisitMembers)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSitevisitMembers', [$sitevisitMembers]);

        return parent::setSitevisitMembers($sitevisitMembers);
    }

    /**
     * {@inheritDoc}
     */
    public function getSitevisitMembers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSitevisitMembers', []);

        return parent::getSitevisitMembers();
    }

    /**
     * {@inheritDoc}
     */
    public function setTelephonicNewdate($telephonicNewdate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTelephonicNewdate', [$telephonicNewdate]);

        return parent::setTelephonicNewdate($telephonicNewdate);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelephonicNewdate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelephonicNewdate', []);

        return parent::getTelephonicNewdate();
    }

    /**
     * {@inheritDoc}
     */
    public function setRemark($remark)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRemark', [$remark]);

        return parent::setRemark($remark);
    }

    /**
     * {@inheritDoc}
     */
    public function getRemark()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRemark', []);

        return parent::getRemark();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedBy($createdBy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedBy', [$createdBy]);

        return parent::setCreatedBy($createdBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedBy', []);

        return parent::getCreatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateCreated($dateCreated)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateCreated', [$dateCreated]);

        return parent::setDateCreated($dateCreated);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateCreated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateCreated', []);

        return parent::getDateCreated();
    }

}
