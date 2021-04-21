<?php

namespace Masters;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\AmenitiesController::class => Controller\Factory\AmenitiesControllerFactory::class,
            Controller\FeedbackParameterController::class => Controller\Factory\FeedbackParameterControllerFactory::class,
            Controller\LeadSourceController::class => Controller\Factory\LeadSourceControllerFactory::class,
            Controller\LeadStatusController::class => Controller\Factory\LeadStatusControllerFactory::class,
            Controller\PreferredLocationController::class => Controller\Factory\PreferredLocationControllerFactory::class,
            Controller\SystemUsertypeController::class => Controller\Factory\SystemUsertypeControllerFactory::class,
            Controller\TransactionInterestController::class => Controller\Factory\TransactionInterestControllerFactory::class,
            Controller\VirtualNumberController::class => Controller\Factory\VirtualNumberControllerFactory::class,
            Controller\FollowupTypesController::class => Controller\Factory\FollowupTypesControllerFactory::class
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'amenities' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/amenities[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\AmenitiesController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'lead-source' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/lead-source[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\LeadSourceController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'lead-status' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/lead-status[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\LeadStatusController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'preferred-location' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/preferred-location[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\PreferredLocationController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'system-usertype' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/system-usertype[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\SystemUsertypeController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'transaction-interest' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/transaction-interest[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\TransactionInterestController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'virtual-number' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/virtual-number[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\VirtualNumberController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'followup-types' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/followup-types[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\FollowupTypesController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\AmenitiesController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+masters.manage'],
                ],
            Controller\LeadSourceController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+masters.manage'],
                ],
            Controller\LeadStatusController::class => [
                ['actions' => ['index','add','edit','delete','status'], 'allow' => '+masters.manage'],
                ],
            Controller\PreferredLocationController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+masters.manage'],
                ],
            Controller\SystemUsertypeController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+masters.manage'],
                ],
            Controller\TransactionInterestController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+masters.manage'],
                ],
            Controller\VirtualNumberController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+masters.manage'],
                ],
            Controller\FollowupTypesController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+masters.manage'],
                ],
        ],
],
    'view_manager' => [
        'template_path_stack' => [
            'masters' => __DIR__ . '/../view',
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
