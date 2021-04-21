<?php
namespace Campaigns\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Campaigns\Entity\Campaigns;
use Campaigns\Entity\CampaignProjects;
use Projects\Entity\Projects;
use Leads\Entity\Leads;

class CampaignDetail extends AbstractHelper
{
    private $entityManager;

    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function getName($id)
    {
        $campaign = $this->entityManager->getRepository(Campaigns::class)->findOneBy(['id'=>$id], ['id'=>'ASC']);
        return (empty($campaign)?null:$campaign->getCampaignName());
    }
    
    public function getProjects($id)
    {
        $campaign_projects = $this->entityManager->getRepository(CampaignProjects::class)->findBy(['campaignId'=>$id], ['id'=>'ASC']);
        $projects = '';
        foreach ($campaign_projects as $campaign_project) {
            $project = $this->entityManager->getRepository(Projects::class)->findOneBy(['id'=>$campaign_project->getProjectId()], ['id'=>'ASC']);
            $projects .= (empty($project)?'':$project->getName()).', ';
        }
        return (empty($projects)?'Corporate Level Campaign' : rtrim($projects, ', '));
    }
    
    public function getCampaignLeads($id)
    {
        $leads = $this->entityManager->getRepository(Leads::class)->findBy(['campaign'=>$id], ['id'=>'ASC']);
        return count($leads);
    }
    
    public function getCampaignSiteVisits($id)
    {
        $leads = $this->entityManager->getRepository(Leads::class)->findBy(['campaign'=>$id, 'status'=>'32'], ['id'=>'ASC']);
        return count($leads);
    }
}
