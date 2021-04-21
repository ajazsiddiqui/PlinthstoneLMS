<?php
namespace Projects\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Masters\Entity\PreferredLocation;
use Projects\Entity\Projects;

class ProjectDetails extends AbstractHelper
{
    private $entityManager;

    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }
    
    public function getLocation($id)
    {
        $location = $this->entityManager->getRepository(PreferredLocation::class)
                       ->findOneBy(['id'=>$id]);
        return (empty($location)?null:$location->getName());
    }
    
    public function getName($id)
    {
        $project = $this->entityManager->getRepository(Projects::class)
                       ->findOneBy(['id'=>$id]);
        return (empty($project)?null:$project->getName());
    }
    
    public function getDeveloper($id)
    {
        $project = $this->entityManager->getRepository(Projects::class)
                       ->findOneBy(['id'=>$id]);
        return (empty($project)?null:$project->getDeveloper());
    }
}
