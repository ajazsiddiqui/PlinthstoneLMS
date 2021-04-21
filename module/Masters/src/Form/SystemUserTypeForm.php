<?php

namespace Masters\Form;

use Zend\Form\Form;

class SystemUserTypeForm extends Form
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
                'label' => 'System Userype',
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
            'name' => 'eod_status',
            'options' => [
                'label' => 'EOD mails to be sent?*',
                'value_options' => [
                    '0' => 'No',
                    '1' => 'Yes',
                    ],
            ],
            'type'  => 'Select',
        ]);
        
        $this->add([
            'name' => 'negotiation_percent',
            'options' => [
                'label' => 'Negotiation Percent'
            ],
            'type'  => 'Text',
        ]);
        
        $this->add([
            'name' => 'number_mask',
            'options' => [
                'label' => 'Mask Numbers',
                'value_options' => [
                    '0' => 'No',
                    '1' => 'Yes',
                    ],
            ],
            'type'  => 'Select',
        ]);
        
        $this->add([
            'name' => 'confidential',
            'options' => [
                'label' => 'Confidential',
                'value_options' => [
                    '0' => 'No',
                    '1' => 'Yes',
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
