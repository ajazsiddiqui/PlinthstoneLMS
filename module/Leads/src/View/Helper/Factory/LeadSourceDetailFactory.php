<?php
namespace Leads\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Leads\View\Helper\LeadSourceDetail;

class LeadSourceDetailFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);

        return new LeadSourceDetail($authenticationService, $entityManager);
    }
}
