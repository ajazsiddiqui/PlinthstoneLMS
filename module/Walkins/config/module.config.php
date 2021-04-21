<?php

namespace Walkins;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\WalkinsController::class => Controller\Factory\WalkinsControllerFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'walkins' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/walkins[/:action[/:id][/:walkins_id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\WalkinsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\WalkinsController::class => [
                ['actions' => ['index'], 'allow' => '+walkins.manage'],
                ]
            ],
        ],

    'view_manager' => [
        'template_path_stack' => [
            'walkins' => __DIR__ . '/../view',
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
