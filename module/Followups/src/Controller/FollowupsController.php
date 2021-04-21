<?php

namespace Followups\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Leads\Entity\Leads;
use Followups\Entity\Followups;
use Projects\Entity\Projects;
use Masters\Entity\FollowupTypes;
use Notifications\Entity\SmsTemplates;
use Notifications\Entity\EmailTemplates;
use Campaigns\Entity\Campaigns;
use Masters\Entity\LeadStatus;
use Masters\Entity\LeadSource;

class FollowupsController extends AbstractActionController
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

    public function indexAction()
    {
        $request = $this->getRequest();
        
        $search_array = $this->params()->fromQuery('search', []);
        $search_array = empty($search_array)?[]:unserialize(base64_decode($search_array));
        
        $post = $request->getPost()->toArray();
        empty($post)?$post = $search_array:'';
        
        $result = $this->entityManager->createQueryBuilder();

        $query = $result->select('l,f')
                ->from('Leads\Entity\Leads', 'l')
                ->join('Followups\Entity\Followups', 'f', 'WITH', 'f.leadId = l.id');
                
        if (!empty($post)) {
            $dates = explode(" - ", $post['daterange']);
            $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
            $enddate = $this->LMSUtilities->makeDBDate($dates[1]);
            
            $query->where('f.followDate between :startdate and :enddate')
                  ->setParameter('startdate', $startdate)
                  ->setParameter('enddate', $enddate);
              
            empty($post['s_id'])?'':$query->AndWhere('l.id = :id')->setParameter('id', $post['s_id']);
            empty($post['s_type'])?'':$query->AndWhere('l.mode = :mode')->setParameter('mode', $post['s_type']);
            empty($post['s_customer'])?'':$query->AndWhere('l.id = :customer')->setParameter('customer', $post['s_customer']);
            empty($post['s_project'])?'':$query->AndWhere('l.project = :project')->setParameter('project', $post['s_project']);
            empty($post['s_campaign'])?'':$query->AndWhere('l.projectCampaign = :campaign')->setParameter('campaign', $post['s_campaign']);
            empty($post['s_status'])?'':$query->AndWhere('l.status = :status')->setParameter('status', $post['s_status']);
            empty($post['s_source'])?'':$query->AndWhere('l.source = :source')->setParameter('source', $post['s_source']);
        }
        

        $paginator['page'] = $this->params()->fromQuery('page', 1);
        $paginator['count'] = count($query->getQuery()->getScalarResult());
        $paginator['per_page'] = 10;
        $offset = $paginator['page'] * $paginator['per_page'] - $paginator['per_page'];
        
        $query->setFirstResult($offset)->setMaxResults($paginator['per_page'])->add('orderBy', 'l.id DESC');
                  
        $leads = $query->getQuery()->getScalarResult();

        $i =0;
        foreach ($leads as $lead) {
            $followup = $this->entityManager->getRepository(Followups::class)->findOneBy(['leadId'=>$lead['l_id']], ['id' => 'DESC']);
            $project = $this->entityManager->getRepository(Projects::class)->findOneBy(['id'=>$lead['l_project']]);
            $FollowupTypes = $this->entityManager->getRepository(FollowupTypes::class)->findOneBy(['id'=>$followup->getFollowupType()]);
            $leads[$i]['followup_type'] = empty($FollowupTypes)?'':$FollowupTypes->getName();
            $leads[$i]['followup_date'] = empty($followup)?'':$followup->getFollowDate();
            $leads[$i]['project_details'] = empty($project)?'':$project->getName();
            $i++;
        }

        $customers = $this->entityManager->getRepository(Leads::class)->findBy(['interested'=>1]);
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $projects = $this->entityManager->getRepository(Projects::class)->findAll();
        $campaigns = $this->entityManager->getRepository(Campaigns::class)->findAll();
        $status = $this->entityManager->getRepository(LeadStatus::class)->findAll();
        $source = $this->entityManager->getRepository(LeadSource::class)->findAll();

        $smstemplates = $this->entityManager->getRepository(SmsTemplates::class)
                   ->findBy([], ['id'=>'ASC']);
        $emailtemplates = $this->entityManager->getRepository(EmailTemplates::class)
                   ->findBy([], ['id'=>'ASC']);

        return new ViewModel(['leads' => $leads,'customers'=>$customers, 'campaigns'=>$campaigns, 'source'=>$source, 'status' => $status, 'search_array' => $post,  'users' => $users, 'projects' => $projects, 'smstemplates' => $smstemplates, 'emailtemplates' => $emailtemplates,'paginator' => $paginator]);
    }


    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $followups = $this->entityManager->getRepository(Followups::class)
                ->find($id);
        $this->entityManager->remove($followups);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Followups Deleted', $id, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Followups Deleted'. $id);
        return $this->redirect()->toRoute('followups', ['action'=>'index']);
    }
}
