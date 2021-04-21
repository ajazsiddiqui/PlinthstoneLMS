<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\LeadSourceForm;
use Masters\Entity\LeadSource;
use User\Entity\User;

class LeadSourceController extends AbstractActionController
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
        $form = new LeadSourceForm();
        $lead_source = $this->entityManager->getRepository(LeadSource::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['lead_source'=>$lead_source,'form'=>$form]);
    }

    public function addAction()
    {
        $form = new LeadSourceForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $lead_source = new LeadSource();
                    $lead_source->setName($data['name']);
                    $lead_source->setIcon($data['icon']);
                    $lead_source->setStatus($data['status']);
                    $lead_source->setCreatedBy($user->getId());
                    $this->entityManager->persist($lead_source);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('LeadSource Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addSuccessMessage('LeadSource Added '. $data['name']);
            return $this->redirect()->toRoute('lead-source', ['action'=>'index']);
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

        $lead_source = $this->entityManager->getRepository(LeadSource::class)
                ->find($id);

        if ($lead_source == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new LeadSourceForm();

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $lead_source->setName($data['name']);
                    $lead_source->setIcon($data['icon']);
                    $lead_source->setStatus($data['status']);
                    $lead_source->setCreatedBy($user->getId());
                    $this->entityManager->persist($lead_source);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('LeadSource Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('LeadSource Edited '. $data['name']);
                return $this->redirect()->toRoute('lead-source', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
              'name'=>$lead_source->getName(),
              'status'=>$lead_source->getStatus(),
              'icon'=>$lead_source->getIcon()
                ));
        }

        return new ViewModel(['form' => $form,'icon'=>$lead_source->getIcon()]);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $lead_source = $this->entityManager->getRepository(LeadSource::class)
                ->find($id);
        $name = $lead_source->getName();
        $this->entityManager->remove($lead_source);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('LeadSource Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('LeadSource Deleted '. $name);
        return $this->redirect()->toRoute('lead-source', ['action'=>'index']);
    }
}
