<?php

namespace Walkins\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Leads\Entity\Leads;
use Notifications\Entity\SmsTemplates;
use Notifications\Entity\EmailTemplates;

class WalkinsController extends AbstractActionController
{
    private $authService;
    private $entityManager;
    private $logManager;
    private $LMSUtilities;
    private $logger;

    public function __construct($authService, $entityManager, $logManager, $LMSUtilities, $logger)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
        $this->logManager = $logManager;
        $this->LMSUtilities = $LMSUtilities;
        $this->logger = $logger;
    }

    public function init()
    {
        if ($user = $this->identity()) {
        } else {
            return $this->redirect()->toRoute('login');
        }
    }

    public function indexAction()
    {
        $leads = $this->entityManager->getRepository(Leads::class)->findBy(['visited'=>1]);
        $customers = $this->entityManager->getRepository(Leads::class)->findBy(['visited'=>1]);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            $leads = $this->entityManager->getRepository(Leads::class)->findBy(['id'=>$post['s_customer'],'visited'=>1], ['id' => 'ASC']);

            $smstemplates = $this->entityManager->getRepository(SmsTemplates::class)
             ->findBy([], ['id'=>'ASC']);
            $emailtemplates = $this->entityManager->getRepository(EmailTemplates::class)
             ->findBy([], ['id'=>'ASC']);

            return new ViewModel(['search_array'=>$post, 'leads'=>$leads, 'customers' => $customers, 'smstemplates' => $smstemplates, 'emailtemplates' => $emailtemplates]);
        } else {
            return new ViewModel(['customers' => $customers, 'leads' => $leads]);
        }
    }
}
