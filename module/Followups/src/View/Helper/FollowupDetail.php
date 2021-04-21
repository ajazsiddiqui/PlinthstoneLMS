<?php
namespace Followups\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Followups\Entity\Followups;
use Masters\Entity\FollowupTypes;

class FollowupDetail extends AbstractHelper
{
    private $entityManager;

    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function getFollowupType($id)
    {
        $FollowupTypes = $this->entityManager->getRepository(FollowupTypes::class)->findOneBy(['id'=>$id]);
        return (empty($FollowupTypes)?null:$FollowupTypes->getName());
    }

    public function getFollowupDate($id)
    {
        $followups = $this->entityManager->getRepository(Followups::class)->findOneBy(['leadId'=>$id], ['id'=>'ASC']);
        return (empty($followups)?null:$followups->getActionDate());
    }
}
