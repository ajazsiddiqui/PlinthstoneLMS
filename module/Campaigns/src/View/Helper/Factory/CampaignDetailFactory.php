<?php
namespace Campaigns\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Campaigns\View\Helper\CampaignDetail;

class CampaignDetailFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);

        return new CampaignDetail($authenticationService, $entityManager);
    }
}
