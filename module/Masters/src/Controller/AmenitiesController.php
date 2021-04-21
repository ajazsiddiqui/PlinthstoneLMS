<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\AmenitiesForm;
use Masters\Entity\Amenities;
use User\Entity\User;

class AmenitiesController extends AbstractActionController
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
        $form = new AmenitiesForm();
        $amenities = $this->entityManager->getRepository(Amenities::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['amenities'=>$amenities, 'form'=>$form]);
    }

    public function addAction()
    {
        $form = new AmenitiesForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $amenity = new Amenities();
                    $amenity->setName($data['name']);
                    $amenity->setStatus($data['status']);
                    $amenity->setType($data['type']);
                    $amenity->setCreatedBy($user->getId());
                    $this->entityManager->persist($amenity);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Amenities Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }

            $this->flashMessenger()->addSuccessMessage('Amenities Added '. $data['name']);
            return $this->redirect()->toRoute('amenities', ['action'=>'index']);
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

        $amenity = $this->entityManager->getRepository(Amenities::class)
                ->find($id);

        if ($amenity == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new AmenitiesForm();

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $amenity->setName($data['name']);
                    $amenity->setStatus($data['status']);
                    $amenity->setType($data['type']);
                    $amenity->setCreatedBy($user->getId());
                    $this->entityManager->persist($amenity);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Amenities Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('Amenities edited '. $data['name']);
                return $this->redirect()->toRoute('amenities', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                    'name'=>$amenity->getName(),
                    'type'=>$amenity->getType(),
                    'status'=>$amenity->getStatus()
                ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $amenity = $this->entityManager->getRepository(Amenities::class)
                ->find($id);
        $amenity_name = $amenity->getName();
        $this->entityManager->remove($amenity);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Amenities Deleted', $amenity_name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Amenities deleted '. $amenity_name);
        return $this->redirect()->toRoute('amenities', ['action'=>'index']);
    }
}
