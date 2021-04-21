<?php

namespace Masters\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Masters\Controller\FollowupTypesController;
use Application\Service\LogManager;

class FollowupTypesControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return AuthAdapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('file_manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        $logManager = $container->get(LogManager::class);

        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);
        $LMSUtilities = $container->get(\Application\Service\LMSUtilities::class);

        $writer = new \Zend\Log\Writer\Stream($config['logger']);
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        return new FollowupTypesController($authenticationService, $entityManager, $logManager, $LMSUtilities, $logger);
    }
}
