<?php
namespace Leads\Form;

use Zend\Form\Form;

class LeadsForm extends Form
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
        $this->add(['name' => 'first_name', 'options' => ['label' => 'First Name', ], 'type' => 'Text', ]);
        $this->add(['name' => 'last_name', 'options' => ['label' => 'Last Name', ], 'type' => 'Text', ]);
        $this->add(['name' => 'contact', 'options' => ['label' => 'Contact', ], 'type' => 'Text', ]);
        $this->add(['name' => 'email', 'options' => ['label' => 'Email', ], 'type' => 'Text', ]);
        $this->add(['name' => 'city', 'options' => ['label' => 'City', 'disable_inarray_validator' => true, ], 'type' => 'Select', ]);
        $this->add(['name' => 'state', 'options' => ['label' => 'State', 'disable_inarray_validator' => true, ], 'type' => 'Select', ]);

        // interest
        $this->add(['name' => 'location', 'options' => ['label' => 'Preferred Location', 'disable_inarray_validator' => true, ], 'type' => 'Select', ]);
        $this->add(['name' => 'configuration', 'options' => ['label' => 'Interested Flat Configuration'], 'type' => 'Select', ]);

        // project requirement
        $this->add(['name' => 'project', 'options' => ['label' => 'Project Name', 'disable_inarray_validator' => true, ], 'type' => 'Select', ]);
        $this->add(['name' => 'campaign', 'options' => ['label' => 'Campaign', 'disable_inarray_validator' => true, ], 'type' => 'Select', ]);
        $this->add(['name' => 'source', 'options' => ['label' => 'Lead Source'], 'type' => 'Select']);
        $this->add(['name' => 'status', 'options' => ['label' => 'Lead Status'], 'type' => 'Select']);
        $this->add(['name' => 'interested', 'options' => ['label' => 'Interested','value_options' => [
                'checked_value' => '1',
                'unchecked_value' => '0',
                    ]], 'type' => 'Checkbox']);
        $this->add(['name' => 'remarks', 'options' => ['label' => 'Remarks' ], 'type' => 'Textarea', ]);
        //Followup
        $this->add(['name' => 'followup_type', 'options' => ['label' => 'Followup Type'], 'type' => 'Select' ]);
        
        //Date
        $this->add(['name' => 'follow_date', 'options' => ['label' => 'Date', ], 'type' => 'Text' ]);
        
        $this->add(['name' => 'created_by', 'type' => 'hidden', ]);
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'id' => 'submitbutton',
                'class' => 'btn btn-success'
            ) ,
        ));
    }

    public function setFilters()
    {
        $this->getInputFilter()->get('email')->setRequired(false);
        $this->getInputFilter()->get('state')->setRequired(false);
        $this->getInputFilter()->get('city')->setRequired(false);
        $this->getInputFilter()->get('location')->setRequired(false);
        $this->getInputFilter()->get('configuration')->setRequired(false);
        $this->getInputFilter()->get('project')->setRequired(false);
        $this->getInputFilter()->get('campaign')->setRequired(false);
        $this->getInputFilter()->get('source')->setRequired(false);
        $this->getInputFilter()->get('interested')->setRequired(false);
        $this->getInputFilter()->get('followup_type')->setRequired(false);
        $this->getInputFilter()->get('follow_date')->setRequired(false);
        $this->getInputFilter()->get('remarks')->setRequired(false);
        $this->getInputFilter()->get('status')->setRequired(false);
    }
}
