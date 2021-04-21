<?php

namespace Campaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Campaigns\Entity\Campaigns;
use Campaigns\Entity\CampaignProjects;
use Campaigns\Form\CampaignForm;
use Projects\Entity\Projects;

class CampaignController extends AbstractActionController
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
        $campaigns = $this->entityManager->getRepository(Campaigns::class)
                   ->findBy([], ['id'=>'ASC']);

        return new ViewModel(['campaigns' => $campaigns]);
    }

    public function addAction()
    {
        $form = new CampaignForm();
        $form->get('projects')->setValueOptions($this->LMSUtilities->projectsList());
        $form->get('virtual_number')->setValueOptions($this->LMSUtilities->VirtualNumbersList());

        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $campaigns = new Campaigns();
                    $campaigns->setCampaignName($data['campaign_name']);
                    $campaigns->setTotalBudget($data['total_budget']);
                    $campaigns->setTotalSpent($data['total_spent']);
                    $campaigns->setFromDate($this->LMSUtilities->makeDate($data['from_date']));
                    $campaigns->setToDate($this->LMSUtilities->makeDate($data['to_date']));
                    $campaigns->setCampaignType($data['campaign_type']);
                    $campaigns->setVirtualNumber($data['virtual_number']);
                    $campaigns->setStatus($data['status']);
                    $campaigns->setCampaignDescription($data['campaign_description']);
                    $campaigns->setCreatedBy($user->getId());
                    $this->entityManager->persist($campaigns);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $campaign_id = $campaigns->getId();

                $campaign_projects = new CampaignProjects();

                foreach ($data['projects'] as $project) {
                    $campaign_projects->setCampaignId($campaign_id);
                    $campaign_projects->setProjectId($project);
                    $campaign_projects->setCreatedBy($user->getId());
                    $this->entityManager->persist($campaign_projects);
                    $this->entityManager->flush();
                }

                $log = $this->logManager;
                $log->setlog('Campaign Added', $campaign_id, $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }

            $this->flashMessenger()->addSuccessMessage('Campaign edited ', $campaigns->getCampaignName());
            return $this->redirect()->toRoute('campaign', ['action'=>'edit', 'id' => $campaign_id]);
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

        $campaigns = $this->entityManager->getRepository(Campaigns::class)
                ->find($id);

        $campaign_projects = $this->entityManager->getRepository(CampaignProjects::class)
                ->findBy(['campaignId' => $campaigns->getid()]);

        $projects = [];
        foreach ($campaign_projects as $campaign_project) {
            $project = $this->entityManager->getRepository(Projects::class)->findOneBy(['id'=>$campaign_project->getProjectId()], ['id'=>'ASC']);
            $projects[] = (empty($project)?'':$project->getId());
        }


        if ($campaigns == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new CampaignForm();
        $form->get('projects')->setValueOptions($this->LMSUtilities->projectsList());
        $form->get('virtual_number')->setValueOptions($this->LMSUtilities->VirtualNumbersList());

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $campaigns->setCampaignName($data['campaign_name']);
                    $campaigns->setTotalBudget($data['total_budget']);
                    $campaigns->setTotalSpent($data['total_spent']);
                    $campaigns->setFromDate($this->LMSUtilities->makeDate($data['from_date']));
                    $campaigns->setToDate($this->LMSUtilities->makeDate($data['to_date']));
                    $campaigns->setCampaignType($data['campaign_type']);
                    $campaigns->setVirtualNumber($data['virtual_number']);
                    $campaigns->setStatus($data['status']);
                    $campaigns->setCampaignDescription($data['campaign_description']);
                    $campaigns->setCreatedBy($user->getId());
                    $this->entityManager->persist($campaigns);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                foreach ($campaign_projects as $campaign_project) {
                    $this->entityManager->remove($campaign_project);
                    $this->entityManager->flush();
                }

                if (!empty($data['projects'])) {
                    foreach ($data['projects'] as $project) {
                        $new_campaign_projects = new CampaignProjects();
                        $new_campaign_projects->setCampaignId($campaigns->getId());
                        $new_campaign_projects->setProjectId($project);
                        $new_campaign_projects->setCreatedBy($user->getId());
                        $this->entityManager->persist($new_campaign_projects);
                        $this->entityManager->flush();
                    }
                }
                $log = $this->logManager;
                $log->setlog('Campaign Edited', $data['campaign_name'], $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('Campaign Edited ', $campaigns->getCampaignName());
                return $this->redirect()->toRoute('campaign', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            (($campaigns->getCampaignType() ==1)? $form->get('projects')->setAttributes(['disabled' => false]):'');
            $form->setData(array(
                'campaign_name' => $campaigns->getCampaignName(),
                'total_budget' => $campaigns->getTotalBudget(),
                'total_spent' => $campaigns->getTotalSpent(),
                'from_date' => $campaigns->getFromDate(),
                'to_date' => $campaigns->getToDate(),
                'campaign_type' => $campaigns->getCampaignType(),
                'virtual_number' => $campaigns->getVirtualNumber(),
                'projects' => $projects,
                'status' => $campaigns->getStatus(),
                'campaign_description' => $campaigns->getCampaignDescription(),
                    ));
        }

        return new ViewModel(array('id' => $id, 'form' => $form));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $campaigns = $this->entityManager->getRepository(Campaigns::class)
                    ->find($id);
        $name = $campaigns->getCampaignName();
        $this->entityManager->remove($campaigns);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Campaign Medium Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Campaign Deleted ', $name);
        return $this->redirect()->toRoute('campaign', ['action'=>'index']);
    }
}
