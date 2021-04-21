<?php
namespace Leads\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Masters\Entity\LeadSource;

class LeadSourceDetail extends AbstractHelper
{
    private $entityManager;

    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function getName($id)
    {
        if (!empty($id)) {
            $lead = $this->entityManager->getRepository(LeadSource::class)->findOneBy(['id'=>$id], ['id'=>'ASC']);
            return (empty($lead)?null:$lead->getName());
        }
    }
    
    public function getIcon($id)
    {
        if (!empty($id)) {
            $lead = $this->entityManager->getRepository(LeadSource::class)->findOneBy(['id'=>$id], ['id'=>'ASC']);
            return (empty($lead)?null:$lead->getIcon());
        }
    }
}
