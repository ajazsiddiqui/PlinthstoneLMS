<?php
namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use User\Entity\User;

class UserDetail extends AbstractHelper
{
    private $entityManager;

    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function getUserProfilePic()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email'=>$this->authService->getIdentity()]);
        return $user->getProfilePic();
    }
    
    public function getFullName()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email'=>$this->authService->getIdentity()]);
        return $user->getFullName();
    }
    
    public function getId()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email'=>$this->authService->getIdentity()]);
        return $user->getId();
    }
}
