<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\PreferredLocationForm;
use Masters\Entity\PreferredLocation;
use User\Entity\User;

class PreferredLocationController extends AbstractActionController
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
        $form = new PreferredLocationForm();
        $preferred_location = $this->entityManager->getRepository(PreferredLocation::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['preferred_location'=>$preferred_location,'form'=>$form]);
    }

    public function addAction()
    {
        $form = new PreferredLocationForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                try {
                    $location = new PreferredLocation();
                    $location->setName($data['name']);
                    $location->setStatus($data['status']);
                    $location->setCreatedBy($user->getId());
                    $this->entityManager->persist($location);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('PreferredLocation Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addSuccessMessage('PreferredLocation Added '. $data['name']);
            return $this->redirect()->toRoute('preferred-location', ['action'=>'index']);
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

        $location = $this->entityManager->getRepository(PreferredLocation::class)
                ->find($id);

        if ($location == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create user form
        $form = new PreferredLocationForm();

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $location->setName($data['name']);
                    $location->setStatus($data['status']);
                    $location->setCreatedBy($user->getId());
                    $this->entityManager->persist($location);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('PreferredLocation Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('PreferredLocation Edited '. $data['name']);
                return $this->redirect()->toRoute('preferred-location', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                    'name'=>$location->getName(),
                    'status'=>$location->getStatus()
                ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $location = $this->entityManager->getRepository(PreferredLocation::class)
                ->find($id);
        $name = $location->getName();
        $this->entityManager->remove($location);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('PreferredLocation Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('PreferredLocation Deleted '. $name);
        return $this->redirect()->toRoute('preferred-location', ['action'=>'index']);
    }
}
