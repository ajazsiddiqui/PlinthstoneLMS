<?php
namespace Application\Service;

use Application\Entity\Logs;

class LogManager
{
    private $entityManager;
    
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function setlog($action, $action_name, $user)
    {
        $log = new Logs();
        $log->setAction($action);
        $log->setActionName($action_name);
        $log->setUser($user);
        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }
}
