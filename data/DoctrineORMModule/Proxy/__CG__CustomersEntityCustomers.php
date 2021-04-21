<?php

namespace DoctrineORMModule\Proxy\__CG__\Customers\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Customers extends \Customers\Entity\Customers implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'id', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'customerType', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'firstName', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'lastName', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'email', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'contact', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'alternateNumber', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'state', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'city', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'address', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'currentLocation', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'pincode', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'mode', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'familyIncome', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'industry', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'company', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'designation', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'birthDate', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'anniversaryDate', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'remark', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'dateCreated'];
        }

        return ['__isInitialized__', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'id', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'customerType', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'firstName', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'lastName', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'email', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'contact', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'alternateNumber', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'state', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'city', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'address', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'currentLocation', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'pincode', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'mode', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'familyIncome', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'industry', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'company', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'designation', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'birthDate', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'anniversaryDate', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'remark', '' . "\0" . 'Customers\\Entity\\Customers' . "\0" . 'dateCreated'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Customers $proxy) {
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
    public function setCustomerType($customerType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomerType', [$customerType]);

        return parent::setCustomerType($customerType);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomerType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomerType', []);

        return parent::getCustomerType();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName($firstName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstName', [$firstName]);

        return parent::setFirstName($firstName);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', []);

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastName', [$lastName]);

        return parent::setLastName($lastName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', []);

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setContact($contact)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContact', [$contact]);

        return parent::setContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function getContact()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContact', []);

        return parent::getContact();
    }

    /**
     * {@inheritDoc}
     */
    public function setAlternateNumber($alternateNumber)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAlternateNumber', [$alternateNumber]);

        return parent::setAlternateNumber($alternateNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlternateNumber()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlternateNumber', []);

        return parent::getAlternateNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setState($state)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setState', [$state]);

        return parent::setState($state);
    }

    /**
     * {@inheritDoc}
     */
    public function getState()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getState', []);

        return parent::getState();
    }

    /**
     * {@inheritDoc}
     */
    public function setCity($city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCity', [$city]);

        return parent::setCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function getCity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCity', []);

        return parent::getCity();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddress($address)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddress', [$address]);

        return parent::setAddress($address);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddress', []);

        return parent::getAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrentLocation($currentLocation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurrentLocation', [$currentLocation]);

        return parent::setCurrentLocation($currentLocation);
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentLocation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCurrentLocation', []);

        return parent::getCurrentLocation();
    }

    /**
     * {@inheritDoc}
     */
    public function setPincode($pincode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPincode', [$pincode]);

        return parent::setPincode($pincode);
    }

    /**
     * {@inheritDoc}
     */
    public function getPincode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPincode', []);

        return parent::getPincode();
    }

    /**
     * {@inheritDoc}
     */
    public function setMode($mode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMode', [$mode]);

        return parent::setMode($mode);
    }

    /**
     * {@inheritDoc}
     */
    public function getMode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMode', []);

        return parent::getMode();
    }

    /**
     * {@inheritDoc}
     */
    public function setFamilyIncome($familyIncome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFamilyIncome', [$familyIncome]);

        return parent::setFamilyIncome($familyIncome);
    }

    /**
     * {@inheritDoc}
     */
    public function getFamilyIncome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFamilyIncome', []);

        return parent::getFamilyIncome();
    }

    /**
     * {@inheritDoc}
     */
    public function setIndustry($industry)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIndustry', [$industry]);

        return parent::setIndustry($industry);
    }

    /**
     * {@inheritDoc}
     */
    public function getIndustry()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIndustry', []);

        return parent::getIndustry();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompany($company)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompany', [$company]);

        return parent::setCompany($company);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompany()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompany', []);

        return parent::getCompany();
    }

    /**
     * {@inheritDoc}
     */
    public function setDesignation($designation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDesignation', [$designation]);

        return parent::setDesignation($designation);
    }

    /**
     * {@inheritDoc}
     */
    public function getDesignation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDesignation', []);

        return parent::getDesignation();
    }

    /**
     * {@inheritDoc}
     */
    public function setBirthDate($birthDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBirthDate', [$birthDate]);

        return parent::setBirthDate($birthDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getBirthDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBirthDate', []);

        return parent::getBirthDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setAnniversaryDate($anniversaryDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAnniversaryDate', [$anniversaryDate]);

        return parent::setAnniversaryDate($anniversaryDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getAnniversaryDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAnniversaryDate', []);

        return parent::getAnniversaryDate();
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