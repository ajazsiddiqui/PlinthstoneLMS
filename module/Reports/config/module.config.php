<?php

namespace Reports;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\ReportsController::class => Controller\Factory\ReportsControllerFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'reports' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/reports[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\ReportsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\ReportsController::class => [
                ['actions' => ['index','projectreport','sourcereport','leadsreport','followupreport','campaignreport'], 'allow' => '+reports.manage'],
                ]
            ],
        ],
    'view_manager' => [
        'template_path_stack' => [
            'reports' => __DIR__ . '/../view',
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
