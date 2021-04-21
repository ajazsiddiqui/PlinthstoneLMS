<?php

namespace Campaigns\Form;

use Zend\Form\Form;

class CampaignForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->addElements();
        $this->setFilters();
    }

    public function addElements()
    {
        $this->add([
            'name' => 'campaign_name',
            'options' => [
                'label' => 'Campaign Name',
            ],
            'type'  => 'Text',
        ]);
        
        $this->add([
            'name' => 'total_budget',
            'options' => [
                'label' => 'Total Budget',
            ],
            'type'  => 'Text',
        ]);
        
        $this->add([
            'name' => 'total_spent',
            'options' => [
                'label' => 'Total Spent',
            ],
            'type'  => 'Text',
        ]);
        
        $this->add([
            'name' => 'from_date',
            'options' => [
                'label' => 'From Date',
            ],
            'type'  => 'Text',
        ]);

        $this->add([
            'name' => 'to_date',
            'options' => [
                'label' => 'To Date',
            ],
            'type'  => 'Text',
        ]);
        
        $this->add([
            'name' => 'virtual_number',
            'options' => [
                'label' => 'Virtual Number',
            ],
            'type'  => 'Select',
        ]);
        
        $this->add([
            'name' => 'campaign_type',
            'options' => [
                'label' => 'Campaign Type',
            'value_options' => [
                '0' => 'Corporate Level',
                '1' => 'Specific Project',
                    ],
                //'disable_inarray_validator' => true,
            ],
            'type'  => 'Select',
        ]);
        $this->add([
            'name' => 'projects',
            'attributes' => [
                'multiple' => 'multiple',
                'disabled' => 'disabled',
            ],
            'options' => [
                'label' => 'Projects',
                'disable_inarray_validator' => true,
            ],
            'type'  => 'Select',
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
            'name' => 'campaign_description',
            'options' => [
                'label' => 'Description',
            ],
            'type'  => 'Textarea',
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
    
    public function setFilters()
    {
        $this->getInputFilter()->get('projects')->setRequired(false);
    }
}
