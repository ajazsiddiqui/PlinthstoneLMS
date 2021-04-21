<?php

namespace Followups;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\FollowupsController::class => Controller\Factory\FollowupsControllerFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'followups' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/followups[/:action[/:id][/:followups_id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\FollowupsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'access_filter' => [
        'controllers' => [
            Controller\FollowupsController::class => [
                ['actions' => ['index','add','edit','delete','new'], 'allow' => '+followups.manage'],
                ]
            ],
        ],
    'service_manager' => [
        'factories' => [
            \Bookigs\Service\BookingsService::class => \Bookings\Service\Factory\BookingsServiceFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'followups' => __DIR__ . '/../view',
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
    ],
        'view_helpers' => [
        'factories' => [
            View\Helper\FollowupDetail::class => View\Helper\Factory\FollowupDetailFactory::class
        ],
       'aliases' => [
            'FollowupDetail' => View\Helper\FollowupDetail::class
       ]
    ],

];
