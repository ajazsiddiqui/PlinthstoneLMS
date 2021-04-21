<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\FollowupTypesForm;
use Masters\Entity\FollowupTypes;
use User\Entity\User;

class FollowupTypesController extends AbstractActionController
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
        $form = new FollowupTypesForm();
        $followup_types = $this->entityManager->getRepository(FollowupTypes::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['followup_types'=>$followup_types,'form'=>$form]);
    }

    public function addAction()
    {
        $form = new FollowupTypesForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $touchpoint = new FollowupTypes();
                    $touchpoint->setName($data['name']);
                    $touchpoint->setStatus($data['status']);
                    $this->entityManager->persist($touchpoint);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Touch Point Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addSuccessMessage('TouchPoint Added '. $data['name']);
            return $this->redirect()->toRoute('followup-types', ['action'=>'index']);
        }

        return new ViewModel(['form'=>$form]);
    }

    public function editAction()
    {
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);


        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $touchpoint = $this->entityManager->getRepository(FollowupTypes::class)
                ->find($id);

        if ($touchpoint == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create user form
        $form = new FollowupTypesForm();

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $touchpoint->setName($data['name']);
                    $touchpoint->setStatus($data['status']);
                    $this->entityManager->persist($touchpoint);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Touch Point Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('TouchPoint Edited '. $data['name']);
                return $this->redirect()->toRoute('followup-types', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                    'name'=>$touchpoint->getName(),
                    'status'=>$touchpoint->getStatus()
                ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $touchpoint = $this->entityManager->getRepository(FollowupTypes::class)
                ->find($id);
        $name = $touchpoint->getName();
        $this->entityManager->remove($touchpoint);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Touch Point Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('TouchPoint Deleted ' . $name);
        return $this->redirect()->toRoute('followup-types', ['action'=>'index']);
    }
}
