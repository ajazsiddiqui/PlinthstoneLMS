<?php

namespace DoctrineORMModule\Proxy\__CG__\Projects\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Projects extends \Projects\Entity\Projects implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'id', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'name', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'city', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'address', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'longitude', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'lattitude', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'internalAmenities', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'externalAmenities', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'startDate', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'completionDate', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'projectStatus', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'brochure', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'isProduction', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'status', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'createdBy', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'dateCreated'];
        }

        return ['__isInitialized__', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'id', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'name', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'city', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'address', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'longitude', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'lattitude', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'internalAmenities', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'externalAmenities', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'startDate', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'completionDate', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'projectStatus', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'brochure', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'isProduction', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'status', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'createdBy', '' . "\0" . 'Projects\\Entity\\Projects' . "\0" . 'dateCreated'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Projects $proxy) {
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
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', [$name]);

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
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
    public function setLongitude($longitude)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLongitude', [$longitude]);

        return parent::setLongitude($longitude);
    }

    /**
     * {@inheritDoc}
     */
    public function getLongitude()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLongitude', []);

        return parent::getLongitude();
    }

    /**
     * {@inheritDoc}
     */
    public function setLattitude($lattitude)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLattitude', [$lattitude]);

        return parent::setLattitude($lattitude);
    }

    /**
     * {@inheritDoc}
     */
    public function getLattitude()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLattitude', []);

        return parent::getLattitude();
    }

    /**
     * {@inheritDoc}
     */
    public function setInternalAmenities($internalAmenities)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInternalAmenities', [$internalAmenities]);

        return parent::setInternalAmenities($internalAmenities);
    }

    /**
     * {@inheritDoc}
     */
    public function getInternalAmenities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInternalAmenities', []);

        return parent::getInternalAmenities();
    }

    /**
     * {@inheritDoc}
     */
    public function setExternalAmenities($externalAmenities)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExternalAmenities', [$externalAmenities]);

        return parent::setExternalAmenities($externalAmenities);
    }

    /**
     * {@inheritDoc}
     */
    public function getExternalAmenities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExternalAmenities', []);

        return parent::getExternalAmenities();
    }

    /**
     * {@inheritDoc}
     */
    public function setStartDate($startDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStartDate', [$startDate]);

        return parent::setStartDate($startDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStartDate', []);

        return parent::getStartDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompletionDate($completionDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompletionDate', [$completionDate]);

        return parent::setCompletionDate($completionDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompletionDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompletionDate', []);

        return parent::getCompletionDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setProjectStatus($projectStatus)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProjectStatus', [$projectStatus]);

        return parent::setProjectStatus($projectStatus);
    }

    /**
     * {@inheritDoc}
     */
    public function getProjectStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProjectStatus', []);

        return parent::getProjectStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setBrochure($brochure)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBrochure', [$brochure]);

        return parent::setBrochure($brochure);
    }

    /**
     * {@inheritDoc}
     */
    public function getBrochure()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBrochure', []);

        return parent::getBrochure();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsProduction($isProduction)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsProduction', [$isProduction]);

        return parent::setIsProduction($isProduction);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsProduction()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsProduction', []);

        return parent::getIsProduction();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
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
