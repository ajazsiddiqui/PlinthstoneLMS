<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\SystemUserTypeForm;
use Masters\Entity\SystemUserType;
use User\Entity\User;

class SystemUsertypeController extends AbstractActionController
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
        $form = new SystemUserTypeForm();
        $system_usertype = $this->entityManager->getRepository(SystemUserType::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['system_usertype'=>$system_usertype,'form'=>$form]);
    }

    public function addAction()
    {
        $form = new SystemUserTypeForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();


                try {
                    $usertype = new SystemUserType();
                    $usertype->setName($data['name']);
                    $usertype->setStatus($data['status']);
                    $usertype->setNegotiationPercent($data['negotiation_percent']);
                    $usertype->setNumberMask($data['number_mask']);
                    $usertype->setEodStatus($data['eod_status']);
                    $usertype->setConfidential($data['confidential']);
                    $usertype->setCreatedBy($user->getId());
                    $this->entityManager->persist($usertype);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('SystemUserType Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addSuccessMessage('SystemUserType Added '. $data['name']);
            return $this->redirect()->toRoute('system-usertype', ['action'=>'index']);
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

        $usertype = $this->entityManager->getRepository(SystemUserType::class)
                ->find($id);

        if ($usertype == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create user form
        $form = new SystemUserTypeForm();

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $usertype->setName($data['name']);
                    $usertype->setStatus($data['status']);
                    $usertype->setNegotiationPercent($data['negotiation_percent']);
                    $usertype->setNumberMask($data['number_mask']);
                    $usertype->setEodStatus($data['eod_status']);
                    $usertype->setConfidential($data['confidential']);
                    $usertype->setCreatedBy($user->getId());
                    $this->entityManager->persist($usertype);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('SystemUserType Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('SystemUserType Edited '. $data['name']);
                return $this->redirect()->toRoute('system-usertype', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                    'name'=>$usertype->getName(),
                    'negotiation_percent'=>$usertype->getNegotiationPercent(),
                    'number_mask'=>$usertype->getNumberMask(),
                    'eod_status'=>$usertype->getEodStatus(),
                    'confidential'=>$usertype->getConfidential(),
                    'status'=>$usertype->getStatus()
                ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $usertype = $this->entityManager->getRepository(SystemUserType::class)
                ->find($id);
        $name = $usertype->getName();
        $this->entityManager->remove($usertype);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('SystemUserType Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('SystemUserType Deleted '. $name);
        return $this->redirect()->toRoute('system-usertype', ['action'=>'index']);
    }
}
