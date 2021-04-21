<?php
namespace Leads\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Masters\Entity\LeadStatus;

class LeadStatusDetail extends AbstractHelper
{
    private $entityManager;

    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function getName($id)
    {
        $status = $this->entityManager->getRepository(LeadStatus::class)->findOneBy(['id'=>$id]);
        return (empty($status)?null:$status->getName());
    }
    
    public function getColor($id)
    {
        $status = $this->entityManager->getRepository(LeadStatus::class)->findOneBy(['id'=>$id]);
        return (empty($status)?null:$status->getColor());
    }
}
