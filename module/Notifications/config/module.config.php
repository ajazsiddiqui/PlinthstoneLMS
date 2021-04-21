<?php

namespace Notifications;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\NotificationsController::class => Controller\Factory\NotificationsControllerFactory::class,
            Controller\EmailTemplateController::class => Controller\Factory\EmailTemplateControllerFactory::class,
            Controller\SMSTemplateController::class => Controller\Factory\SMSTemplateControllerFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'notifications' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/notifications[/:action[/:id][/:to]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\NotificationsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'emailtemplates' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/emailtemplates[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\EmailTemplateController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'smstemplates' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/smstemplates[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\SMSTemplateController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\NotificationsController::class => [
                ['actions' => ['index','sendsms','sendemail'], 'allow' => '+settings.manage'],
                ],
            Controller\EmailTemplateController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+settings.manage'],
                ],
            Controller\SMSTemplateController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+settings.manage'],
                ]
            ],
        ],

    'view_manager' => [
        'template_path_stack' => [
            'notifications' => __DIR__ . '/../view',
        ],
        'display_exceptions' => true,
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
    ]
    
];
