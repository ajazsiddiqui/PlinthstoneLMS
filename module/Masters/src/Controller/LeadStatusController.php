<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\LeadStatusForm;
use Masters\Entity\LeadStatus;
use User\Entity\User;

class LeadStatusController extends AbstractActionController
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
        $form = new LeadStatusForm();
        $lead_status = $this->entityManager->getRepository(LeadStatus::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['lead_status'=>$lead_status,'form'=>$form]);
    }

    public function addAction()
    {
        $form = new LeadStatusForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $lead_status = new LeadStatus();
                    $lead_status->setName($data['name']);
                    $lead_status->setStatus($data['status']);
                    $lead_status->setColor($data['color']);
                    $lead_status->setCreatedBy($user->getId());
                    $this->entityManager->persist($lead_status);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('LeadStatus Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addSuccessMessage('LeadStatus Added '. $data['name']);
            return $this->redirect()->toRoute('lead-status', ['action'=>'index']);
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

        $lead_status = $this->entityManager->getRepository(LeadStatus::class)
                ->find($id);

        if ($lead_status == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create user form
        $form = new LeadStatusForm();

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $lead_status->setName($data['name']);
                    $lead_status->setStatus($data['status']);
                    $lead_status->setColor($data['color']);
                    $lead_status->setCreatedBy($user->getId());
                    $this->entityManager->persist($lead_status);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('LeadStatus Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('LeadStatus Edited ' . $data['name']);
                return $this->redirect()->toRoute('lead-status', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                    'name'=>$lead_status->getName(),
                    'status'=>$lead_status->getStatus(),
                    'color'=>$lead_status->getColor(),
                ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $lead_status = $this->entityManager->getRepository(LeadStatus::class)
                ->find($id);
        $name = $lead_status->getName();
        $this->entityManager->remove($lead_status);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('LeadStatus Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('LeadStatus Deleted '. $name);
        return $this->redirect()->toRoute('lead-status', ['action'=>'index']);
    }
}
