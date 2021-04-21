<?php

namespace Projects\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Projects\Controller\ProjectsController;
use Application\Service\LogManager;

class ProjectsControllerFactory implements FactoryInterface
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

        $dir = $config['upload_dir'];

        $logManager = $container->get(LogManager::class);
        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);
        $LMSUtilities = $container->get(\Application\Service\LMSUtilities::class);
        
        $writer = new \Zend\Log\Writer\Stream($config['logger']);
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        return new ProjectsController($dir, $authenticationService, $entityManager, $logManager, $LMSUtilities, $logger);
    }
}
