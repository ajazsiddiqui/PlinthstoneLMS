<?php
namespace Application\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TranslatorPluginFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (!$container->has('MvcTranslator')) {
            throw new \Exception("Zend I18n Translator not configured");
        }

        $translator = $container->get('MvcTranslator');
        return new \Application\Controller\Plugin\TranslatorPlugin($translator);
    }
}
