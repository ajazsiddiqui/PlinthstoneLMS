<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PrintController extends AbstractActionController
{
    private $entityManager;
    

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function flatAction()
    {
        $this->layout()->setTemplate('layout/blank');
        return new ViewModel([]);
    }
}
