<?php
namespace Projects\Form;

use Zend\Form\Form;

class ProjectsForm extends Form
{
    protected $_dir;
    
    public function __construct($dir, $name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->_dir = $dir;
        
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->addElements();
    }

    public function addElements()
    {
        $this->add([
            'name' => 'name',
            'options' => [
                'label' => 'Project Name',
            ],
            'type'  => 'Text',
        ]);
        $this->add([
            'name' => 'developer',
            'options' => [
                'label' => 'Developer',
            ],
            'type'  => 'Text',
        ]);
        $this->add(['name' => 'logo', 'options' => ['label' => 'Project Logo', ], 'type' => 'File', 'validators' => [
                    ['name'    => 'FileUploadFile'],
                    [
                        'name'    => 'FileMimeType',
                        'options' => [
                            'mimeType'  => ['image/jpeg', 'image/png']
                        ]
                    ]]]);
        $this->add([
            'name' => 'link',
            'type'  => 'hidden',
        ]);
        
        $this->add([
            'name' => 'city',
            'options' => [
                'label' => 'Project Location',
            ],
            'type'  => 'Select',
        ]);

        $this->add([
            'name' => 'address',
            'options' => [
                'label' => 'Project Address',
            ],
            'type'  => 'Textarea',
        ]);


        $this->add([
            'name' => 'internal_amenities',
            'options' => [
                'label' => 'Internal Amenities',
            ],
            'attributes' => [
                'multiple' => 'multiple',
            ],
            'type'  => 'Select',
        ]);

        $this->add([
            'name' => 'external_amenities',
            'options' => [
                'label' => 'External Amenities',
            ],
            'attributes' => [
                'multiple' => 'multiple',
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
