<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\VirtualNumberForm;
use Masters\Entity\VirtualNumber;
use User\Entity\User;

class VirtualNumberController extends AbstractActionController
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
        $form = new VirtualNumberForm();
        $virtual_number = $this->entityManager->getRepository(VirtualNumber::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['virtual_number'=>$virtual_number,'form'=>$form]);
    }

    public function addAction()
    {
        $form = new VirtualNumberForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $number = new VirtualNumber();
                    $number->setName($data['name']);
                    $number->setStatus($data['status']);
                    $number->setRemarks($data['remarks']);
                    $number->setCreatedBy($user->getId());
                    $this->entityManager->persist($number);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Virtual Number Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addSuccessMessage('VirtualNumber Added '. $data['name']);
            return $this->redirect()->toRoute('virtual-number', ['action'=>'index']);
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

        $number = $this->entityManager->getRepository(VirtualNumber::class)
                ->find($id);

        if ($number == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create user form
        $form = new VirtualNumberForm();

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $number->setName($data['name']);
                    $number->setStatus($data['status']);
                    $number->setRemarks($data['remarks']);
                    $number->setCreatedBy($user->getId());
                    $this->entityManager->persist($number);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Virtual Number Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('VirtualNumber Edited '. $data['name']);
                return $this->redirect()->toRoute('virtual-number', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                    'name'=>$number->getName(),
                    'remarks'=>$number->getRemarks(),
                    'status'=>$number->getStatus()
                ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $number = $this->entityManager->getRepository(VirtualNumber::class)
                ->find($id);
        $name = $number->getName();
        $this->entityManager->remove($number);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('VirtualNumber Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('VirtualNumber Deleted '. $name);
        return $this->redirect()->toRoute('virtual-number', ['action'=>'index']);
    }
}
