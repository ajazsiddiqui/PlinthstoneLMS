<?php
namespace Settings\Form;

use Zend\Form\Form;

class SettingsForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->addElements();
    }

    public function addElements()
    {
        $this->add(['name' => 'company_name', 'options' => ['label' => 'Company', ], 'type' => 'Text']);
        $this->add(['name' => 'company_brief', 'options' => ['label' => 'Company Brief', ], 'type' => 'Textarea']);
        
        $this->add(['name' => 'company_logo', 'options' => ['label' => 'Company Logo', ], 'type' => 'File', 'validators' => [
                    ['name'    => 'FileUploadFile'],
                    [
                        'name'    => 'FileMimeType',
                        'options' => [
                            'mimeType'  => ['image/jpeg', 'image/png']
                        ]
                    ]]]);
        $this->add(['name' => 'favicon', 'options' => ['label' => 'Favicon', ], 'type' => 'File']);
        $this->add(['name' => 'brand_color', 'options' => ['label' => 'Brand Color', ], 'type' => 'Color']);
        $this->add(['name' => 'cp_approval', 'options' => ['label' => 'Approval required for creation of Channel Partner', 'value_options' => ['0' => 'No',	'1' => 'Yes']], 'type' => 'Select']);
        $this->add(['name' => 'page_title', 'options' => ['label' => 'Page Title', ], 'type' => 'Text']);
        $this->add(['name' => 'name_emailer', 'options' => ['label' => 'Name of Emailer', 'disable_inarray_validator' => true], 'type' => 'Text' ]);
        $this->add(['name' => 'email_emailer', 'options' => ['label' => 'Email of Emailer', 'disable_inarray_validator' => true], 'type' => 'Text' ]);
        $this->add(['name' => 'birthday_reminder', 'options' => ['label' => 'Email ID to send Birthday Reminder'], 'type' => 'Text']);
        $this->add(['name' => 'sms_enabled', 'options' => ['label' => 'SMS Enabled', 'value_options' => ['0' => 'No',	'1' => 'Yes']], 'type' => 'Select']);
        $this->add(['name' => 'sms_api', 'options' => ['label' => 'SMS API'], 'type' => 'Text']);
        $this->add(['name' => 'kookoo_api', 'options' => ['label' => 'Kookoo API'], 'type' => 'Text']);
        $this->add(['name' => 'call_api', 'options' => ['label' => 'Call API'], 'type' => 'Text']);
        $this->add(['name' => 'created_by', 'type' => 'Hidden']);
        $this->add(['name' => 'submit',	'attributes' => ['type' => 'submit','value' => 'Submit','id' => 'submitbutton','class' => 'btn btn-success']]);
    }
}
