<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../public',
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'api' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller'    => Controller\APIController::class,
                        'action'        => 'facebook',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller'    => Controller\IndexController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'about' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/about',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'about',
                    ],
                ],
            ],
            'logs' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/logs',
                    'defaults' => [
                        'controller' => Controller\LogsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'print' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/print[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\PrintController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'charts' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/charts[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\ChartsController::class,
                        'action'     => 'charts',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\APIController::class => Controller\Factory\APIControllerFactory::class,
            Controller\PrintController::class => Controller\Factory\PrintControllerFactory::class,
            Controller\LogsController::class => Controller\Factory\LogsControllerFactory::class,
            Controller\ChartsController::class => Controller\Factory\ChartsControllerFactory::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'translator' => Controller\Plugin\Factory\TranslatorPluginFactory::class,
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'options' => [
            // The access filter can work in 'restrictive' (recommended) or 'permissive'
            // mode. In restrictive mode all controller actions must be explicitly listed
            // under the 'access_filter' config key, and access is denied to any not listed
            // action for not logged in users. In permissive mode, if an action is not listed
            // under the 'access_filter' key, access to it is permitted to anyone (even for
            // not logged in users. Restrictive mode is more secure and recommended to use.
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                // Allow anyone to visit "index" and "about" actions
                ['actions' => ['index', 'about'], 'allow' => '@'],
                // Allow authorized users to visit "settings" action
                ['actions' => ['settings'], 'allow' => '@']
            ],
            Controller\ChartsController::class => [
                ['actions' => ['chart','projectchart','pipeline'], 'allow' => '*'],
            ],
            Controller\APIController::class => [
                ['actions' => ['smstemplates','emailtemplates','cities','leads','facebook', 'web','submitLeads'], 'allow' => '*'],
            ],
            Controller\PrintController::class => [
                ['actions' => ['flat'], 'allow' => '*'],
                      ],
            Controller\LogsController::class => [
               ['actions' => ['index'], 'allow' => '*'],
             ],
        ]
    ],
    // This key stores configuration for RBAC manager.
    'rbac_manager' => [
        'assertions' => [Service\RbacAssertionManager::class],
    ],
    'service_manager' => [
        'factories' => [
            Service\NavManager::class => Service\Factory\NavManagerFactory::class,
            Service\RbacAssertionManager::class => Service\Factory\RbacAssertionManagerFactory::class,
            Service\LogManager::class => Service\Factory\LogManagerFactory::class,
            Service\LMSUtilities::class => Service\Factory\LMSUtilitiesFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
          View\Helper\SystemSettings::class => View\Helper\Factory\SystemSettingsFactory::class,
          View\Helper\Menu::class => View\Helper\Factory\MenuFactory::class,
          View\Helper\Breadcrumbs::class => InvokableFactory::class,
          View\Helper\ActionButtons::class => InvokableFactory::class,
        ],
        'aliases' => [
          'SystemSettings' => View\Helper\SystemSettings::class,
          'mainMenu' => View\Helper\Menu::class,
          'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
          'actionButtons' => View\Helper\ActionButtons::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

        'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    'view_helper_config' => [
    'flashmessenger' => [
        'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>',
        'message_close_string'     => '</p></div>',
        'message_separator_string' => '</div><div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'
        ]
    ]
];
