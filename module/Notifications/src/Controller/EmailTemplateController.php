<?php

namespace Notifications\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Notifications\Entity\Notifications;
use User\Entity\User;

use Notifications\Entity\EmailTemplates;
use Notifications\Form\EmailForm;

class EmailTemplateController extends AbstractActionController
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
        $form = new EmailForm();
        $emailtemplates = $this->entityManager->getRepository(EmailTemplates::class)
                   ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['templates' => $emailtemplates, 'form'=>$form]);
    }

    public function addAction()
    {
        $form = new EmailForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $template = new EmailTemplates();
                    $template->setTitle($data['title']);
                    $template->setSubject($data['subject']);
                    $template->setStatus($data['status']);
                    $template->setContent($data['content']);
                    $template->setCreatedBy($user->getId());
                    $this->entityManager->persist($template);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('EmailTemplates Added', $data['title'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }

            $this->flashMessenger()->addSuccessMessage('Email Template Added');
            return $this->redirect()->toRoute('emailtemplates', ['action'=>'index']);
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

        $emailtemplate = $this->entityManager->getRepository(EmailTemplates::class)
                ->find($id);

        if ($emailtemplate == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new EmailForm();

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $emailtemplate->setTitle($data['title']);
                    $emailtemplate->setSubject($data['subject']);
                    $emailtemplate->setStatus($data['status']);
                    $emailtemplate->setContent($data['content']);
                    $emailtemplate->setCreatedBy($user->getId());
                    $this->entityManager->persist($emailtemplate);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('EmailTemplates Edited', $data['title'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('Email Template Upated Succesfully');
                return $this->redirect()->toRoute('emailtemplates', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                'title' => $emailtemplate->getTitle(),
                'subject' => $emailtemplate->getSubject(),
                'status' => $emailtemplate->getStatus(),
                'content' => $emailtemplate->getContent(),
                    ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $emailtemplate = $this->entityManager->getRepository(EmailTemplates::class)
                ->find($id);
        $this->entityManager->remove($emailtemplate);

        $log = $this->logManager;
        $log->setlog('EmailTemplates Deleted', $id, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Email Template Deleted');
        return $this->redirect()->toRoute('emailtemplates', ['action'=>'index']);
    }
}
