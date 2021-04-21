<?php
namespace Notifications\Form;

use Zend\Form\Form;

class EmailForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->addElements();
    }

    public function addElements()
    {
        $this->add(['name' => 'title', 'options' => ['label' => 'Title', ], 'type' => 'Text']);
        $this->add(['name' => 'subject', 'options' => ['label' => 'Subject', ], 'type' => 'Text']);
        $this->add(['name' => 'status','options' => ['label' => 'Status','value_options' => ['checked_value' => '1','unchecked_value' => '0']],'type'  => 'Checkbox']);
        $this->add(['name' => 'content', 'options' => ['label' => 'Content', ], 'type' => 'Textarea']);
        $this->add(['name' => 'created_by', 'type' => 'Hidden']);
        $this->add(['name' => 'submit',	'attributes' => ['type' => 'submit','value' => 'Submit','id' => 'submitbutton','class' => 'btn btn-success']]);
    }
}
