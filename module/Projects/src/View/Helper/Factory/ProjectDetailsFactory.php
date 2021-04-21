<?php
namespace Projects\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Projects\View\Helper\ProjectDetails;

class ProjectDetailsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);

        return new ProjectDetails($authenticationService, $entityManager);
    }
}
