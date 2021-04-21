<?php

namespace FileManager\Form;

use Zend\InputFilter;
use Zend\Form\Element;
use Zend\Form\Form;

class UploadForm extends Form
{
    protected $_dir;

    public function __construct($dir, $tmp, $name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->_dir = $dir;
        $this->_tmp = $tmp;
        
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        // File Input
        $file = new Element\File('file');
        $file->setLabel('')
             ->setAttribute('id', 'file')
             ->setAttribute('multiple', true)
             ->setAttribute('required', true);
        $this->add($file);
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Upload',
                'id' => 'submitbutton',
                'class' => 'btn btn-success'
            ),
        ));
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();
        $fileInput = new InputFilter\FileInput('file');
        $fileInput->setRequired(true);
        $fileInput->getValidatorChain()
            ->attachByName('filesize', array('max' => '2048000'))
            ->attachByName('filemimetype', array('mimeType' => 'image/png, image/x-png, image/jpeg, application/pdf, application/msword, application/excel, application/mspowerpoint, text/plain'));
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => $this->_dir,
                'randomize' => true,
            )
        );
        $inputFilter->add($fileInput);

        $this->setInputFilter($inputFilter);
    }
}
