<?php

namespace Leads;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\LeadsController::class => Controller\Factory\LeadsControllerFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'leads' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/leads[/:action[/:id]]',
                    'constraints' => [
                                'controller' => 'leads',
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\LeadsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'access_filter' => [
        'controllers' => [
            Controller\LeadsController::class => [
                ['actions' => ['index','add','edit','details','excelwriter','excelreader','delete','webformlead','close','visited','junk'], 'allow' => '+leads.manage'],
                ]
            ],
        ],

    'view_manager' => [
        'template_path_stack' => [
            'leads' => __DIR__ . '/../view',
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
    // The following registers our custom view
    // helper classes in view plugin manager.
    'view_helpers' => [
        'factories' => [
            View\Helper\LeadOwnersDetail::class => View\Helper\Factory\LeadOwnersDetailFactory::class,
            View\Helper\LeadStatusDetail::class => View\Helper\Factory\LeadStatusDetailFactory::class,
            View\Helper\LeadSourceDetail::class => View\Helper\Factory\LeadSourceDetailFactory::class,
            View\Helper\LeadDetail::class => View\Helper\Factory\LeadDetailFactory::class
        ],
       'aliases' => [
            'LeadOwnersDetail' => View\Helper\LeadOwnersDetail::class,
            'LeadStatusDetail' => View\Helper\LeadStatusDetail::class,
            'LeadSourceDetail' => View\Helper\LeadSourceDetail::class,
            'LeadDetail' => View\Helper\LeadDetail::class,
       ]
    ],
];
