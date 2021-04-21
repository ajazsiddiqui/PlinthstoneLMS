<?php
namespace Bookings\Service\Factory;

use Interop\Container\ContainerInterface;
use Bookings\Service\BookingsService;

class BookingsServiceFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);
        return new BookingsService($authenticationService, $entityManager);
    }
}
