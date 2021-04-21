<?php
namespace Application\Controller\Plugin;

class TranslatorPlugin extends \Zend\Mvc\Controller\Plugin\AbstractPlugin
{
    /**
     * @var \Zend\I18n\Translator\Translator
     */
    protected $translator;
    public function __construct($translator)
    {
        $this->translator = $translator;
    }
    public function translate($string)
    {
        return $this->translator->translate($string);
    }
}
