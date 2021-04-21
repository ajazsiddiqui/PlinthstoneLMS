<?php
namespace Application\Service\Factory;

use Interop\Container\ContainerInterface;
use Application\Service\LogManager;

class LogManagerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new LogManager($entityManager);
    }
}
