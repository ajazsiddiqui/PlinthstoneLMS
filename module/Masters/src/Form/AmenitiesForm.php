<?php

namespace Masters\Form;

use Zend\Form\Form;

class AmenitiesForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->addElements();
    }

    public function addElements()
    {
        $this->add([
            'name' => 'name',
            'options' => [
                'label' => 'Your name',
            ],
            'type'  => 'Text',
        ]);
        
        $this->add([
            'name' => 'status',
            'options' => [
                'label' => 'Status',
                'value_options' => [
                'checked_value' => '1',
                'unchecked_value' => '0',
                    ],
            ],
            'type'  => 'Checkbox',
        ]);
        
        $this->add([
            'name' => 'type',
            'options' => [
                'label' => 'Amenity Type',
                'value_options' => [
                    '0' => 'Select',
                    '1' => 'Internal',
                    '2' => 'External',
                    ],
            ],
            'type'  => 'Select',
        ]);
        
        $this->add([
            'name' => 'created_by',
            'type'  => 'hidden',
        ]);
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Submit',
                'id' => 'submitbutton',
                'class' => 'btn btn-success'
            ),
        ));
    }
}
