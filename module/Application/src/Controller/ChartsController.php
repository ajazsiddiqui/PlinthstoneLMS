<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Entity\User;
use Leads\Entity\Leads;
use Projects\Entity\Projects;
use Masters\Entity\LeadSource;
use Zend\View\Model\JsonModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class ChartsController extends AbstractActionController
{
    private $entityManager;
    private $LMSUtilities;

    public function __construct($entityManager, $LMSUtilities)
    {
        $this->entityManager = $entityManager;
        $this->LMSUtilities = $LMSUtilities;
    }
    
    public function chartAction()
    {
        $project = $this->params()->fromRoute('id');
		
		$lead_source = $this->entityManager->getRepository(LeadSource::class)
         ->findAll();
         
        $sources = [];
        $enquiry = [];
        $visits = [];
             
        $request = $this->getRequest();
        
        foreach ($lead_source as $source) {
           $sources[] = $source->getName();
           
		   $query = $this->entityManager->createQueryBuilder()->select('l')
              ->from('Leads\Entity\Leads', 'l')
              ->andWhere('l.source = :source')->setParameter(':source', $source->getId());
           
			if(!empty($project)){
				$query->andWhere('l.project = :project')->setParameter(':project', $project);
			}
		   
           $enq = $query->getQuery()->getResult();
           $enquiry[] = count($enq);

           $query = $this->entityManager->createQueryBuilder()->select('l')
              ->from('Leads\Entity\Leads', 'l')
              ->andWhere('l.source = :source')->setParameter(':source', $source->getId())
              ->andWhere('l.visited = :visited')->setParameter(':visited', 1);

			if(!empty($project)){
				$query->andWhere('l.project = :project')->setParameter(':project', $project);
			}

            $vis = $query->getQuery()->getResult();
            $visits[] = count($vis);
        }
        
        $array = ['sources'=>$sources,'enquiry'=>$enquiry,'visits'=>$visits];
        return new JsonModel($array);
    }
    
    public function pipelineAction()
    {
        $leads = [];
        $opportunities = [];
        $visits = [];

        $query = $this->entityManager->createQueryBuilder()->select('l')
          ->from('Leads\Entity\Leads', 'l');
        $lead = $query->getQuery()->getResult();
        $leads[] = count($lead);
        
        $query2 = $this->entityManager->createQueryBuilder()->select('l')
          ->from('Leads\Entity\Leads', 'l')
          ->andWhere('l.interested = :interested')->setParameter(':interested', 1);
        $opportunity = $query2->getQuery()->getResult();
        $opportunities[] = count($opportunity);

        $query3 = $this->entityManager->createQueryBuilder()->select('l')
          ->from('Leads\Entity\Leads', 'l')
          ->andWhere('l.visited = :visited')->setParameter(':visited', 1);

        $visit = $query3->getQuery()->getResult();
        $visits[] = count($visit);

        
        $array = ['leads'=>$leads,'opportunities'=>$opportunities,'visits'=>$visits];
        return new JsonModel($array);
    }

    public function projectchartAction()
    {
        $projects = $this->entityManager->getRepository(Projects::class)
             ->findBy([]);

        $leads = [];
        $enquiry = [];
        $sitevisit = [];
        $sources = [];
       
        foreach ($projects as $project) {
            $sources[] = $project->getName();

            $lead = $this->entityManager->getRepository(Leads::class)
                   ->findBy(['project'=>$project->getId()]);
            $leads[] = count($lead);
            
            $lead = $this->entityManager->getRepository(Leads::class)
                   ->findBy(['project'=>$project->getId(),'interested'=>1]);
            $enquiry[] = count($lead);

            $sitevisits = $this->entityManager->getRepository(Leads::class)
                   ->findBy(['project'=>$project->getId(),'visited'=>1]);
            $sitevisit[] = count($sitevisits);
        }
        $array = ['sources'=>$sources,'leads'=>$leads,'enquiry'=>$enquiry,'sitevisit'=>$sitevisit];
        return new JsonModel($array);
    }
}
