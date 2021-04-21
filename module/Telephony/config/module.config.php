<?php

namespace Telephony;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\TelephonyController::class => Controller\Factory\TelephonyControllerFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'telephony' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/telephony[/:action[/:id][/:telephony_id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\TelephonyController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\TelephonyController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+telephony.manage'],
                ]
            ],
        ],
    'service_manager' => [
        'factories' => [
            Service\TelephonyService::class => Service\Factory\TelephonyServiceFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'telephony' => __DIR__ . '/../view',
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
