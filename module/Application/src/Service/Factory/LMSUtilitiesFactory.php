<?php
namespace Application\Service\Factory;

use Interop\Container\ContainerInterface;
use Application\Service\LMSUtilities;

class LMSUtilitiesFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);
        return new LMSUtilities($authenticationService, $entityManager);
    }
}
