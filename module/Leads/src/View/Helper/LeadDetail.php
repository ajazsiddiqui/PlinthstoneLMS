<?php
namespace Leads\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Leads\Entity\Leads;

class LeadDetail extends AbstractHelper
{
    private $entityManager;

    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function getClosed($id)
    {
        $lead = $this->entityManager->getRepository(Leads::class)->findOneBy(['id'=>$id]);
        if ($lead->getClosed()!=1) {
            return 'Open';
        } else {
            if ($lead->getJunk()==1) {
                return 'Junk';
            } elseif ($lead->getVisited()==1) {
                return 'Visited';
            }
        }
    }
}
