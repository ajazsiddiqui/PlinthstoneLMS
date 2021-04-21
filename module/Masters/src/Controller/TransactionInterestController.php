<?php

namespace Masters\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Masters\Form\TransactionInterestForm;
use Masters\Entity\TransactionInterest;
use User\Entity\User;

class TransactionInterestController extends AbstractActionController
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
        $form = new TransactionInterestForm();
        $transaction_interest = $this->entityManager->getRepository(TransactionInterest::class)
           ->findBy([], ['id'=>'DESC']);
        return new ViewModel(['transaction_interest'=>$transaction_interest,'form'=>$form]);
    }

    public function addAction()
    {
        $form = new TransactionInterestForm();
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();


                try {
                    $transaction = new TransactionInterest();
                    $transaction->setName($data['name']);
                    $transaction->setStatus($data['status']);
                    $transaction->setCreatedBy($user->getId());
                    $this->entityManager->persist($transaction);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('TransactionInterest Added', $data['name'], $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addSuccessMessage('TransactionInterest Added '. $data['name']);
            return $this->redirect()->toRoute('transaction-interest', ['action'=>'index']);
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

        $transaction = $this->entityManager->getRepository(TransactionInterest::class)
                ->find($id);

        if ($transaction == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create user form
        $form = new TransactionInterestForm();

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $transaction->setName($data['name']);
                    $transaction->setStatus($data['status']);
                    $transaction->setCreatedBy($user->getId());
                    $this->entityManager->persist($transaction);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('TransactionInterest Edited', $data['name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('TransactionInterest Edited '. $data['name']);
                return $this->redirect()->toRoute('transaction-interest', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                    'name'=>$transaction->getName(),
                    'status'=>$transaction->getStatus()
                ));
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $transaction = $this->entityManager->getRepository(TransactionInterest::class)
                ->find($id);
        $name = $transaction->getName();
        $this->entityManager->remove($transaction);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('TransactionInterest Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('TransactionInterest Deleted '. $name);
        return $this->redirect()->toRoute('transaction-interest', ['action'=>'index']);
    }
}
