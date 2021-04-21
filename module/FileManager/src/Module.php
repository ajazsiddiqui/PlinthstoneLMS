<?php

namespace FileManager;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    // Add this method:
    // public function getServiceConfig()
    // {
        // return [
            // 'factories' => [
                // Model\FoldersTable::class =>  function($container) {
                    // $tableGateway = $container->get(Model\FoldersTableGateway::class);
                    // return new Model\FoldersTable($tableGateway);
                // },
                // Model\FoldersTableGateway::class => function ($container) {
                    // $dbAdapter = $container->get(AdapterInterface::class);
                    // #$dbAdapter = $container->get('db2');# if use other database then give database name here like db2 is database name
                    // $resultSetPrototype = new ResultSet();
                    // $resultSetPrototype->setArrayObjectPrototype(new Model\Folders());
                    // return new TableGateway('folders', $dbAdapter, null, $resultSetPrototype);
                // },
            // ],
        // ];
    // }
    
    // public function getControllerConfig()
    // {
        // return [
            // 'factories' => [
                // Controller\IndexController::class =>  function($container) {
                    // return new Controller\IndexController(
                        // $container->get(Model\FoldersTable::class)
                    // );
                // },
            // ],
        // ];
    // }
}
