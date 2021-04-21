<?php

namespace Notifications\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Notifications\Entity\Notifications;
use User\Entity\User;

use Notifications\Entity\SmsTemplates;
use Notifications\Form\SMSForm;

class SMSTemplateController extends AbstractActionController
{
    private $authService;
    private $entityManager;
    private $queryBuilder;
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
        $form = new SMSForm();
        $smstemplates = $this->entityManager->getRepository(SmsTemplates::class)
                   ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['templates' => $smstemplates, 'form'=>$form]);
    }

    public function addAction()
    {
        $form = new SMSForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $template = new SmsTemplates();
                    $template->setTitle($data['title']);
                    $template->setStatus($data['status']);
                    $template->setContent($data['content']);
                    $template->setCreatedBy($user->getId());
                    $this->entityManager->persist($template);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('SmsTemplates Added', $data['title'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }

            $this->flashMessenger()->addSuccessMessage('SMS Template Added');
            return $this->redirect()->toRoute('smstemplates', ['action'=>'index']);
        }
        return new ViewModel(['form'=>$form]);
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $smstemplate = $this->entityManager->getRepository(SmsTemplates::class)
                ->find($id);

        if ($smstemplate == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new SMSForm();

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();
                try {
                    $smstemplate->setTitle($data['title']);
                    $smstemplate->setStatus($data['status']);
                    $smstemplate->setContent($data['content']);
                    $smstemplate->setCreatedBy($user->getId());
                    $this->entityManager->persist($smstemplate);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('SmsTemplates Edited', $data['title'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('SMS Template Updated');
                return $this->redirect()->toRoute('smstemplates', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                'title' => $smstemplate->getTitle(),
                'status' => $smstemplate->getStatus(),
                'content' => $smstemplate->getContent(),
                    ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $smstemplate = $this->entityManager->getRepository(SmsTemplates::class)
                ->find($id);
        $this->entityManager->remove($smstemplate);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('SmsTemplates Deleted', $id, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Email Template Deleted');
        return $this->redirect()->toRoute('smstemplates', ['action'=>'index']);
    }
}
