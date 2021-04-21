<?php

namespace Projects;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\ProjectsController::class => Controller\Factory\ProjectsControllerFactory::class
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'projects' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/projects[/:action[/:id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\ProjectsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\ProjectsController::class => [
                ['actions' => ['index','add','edit','delete','details'], 'allow' => '+projects.manage'],]
        ],
],
    'view_manager' => [
        'template_path_stack' => [
            'projects' => __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
        'display_exceptions' => true,
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\ProjectDetails::class => View\Helper\Factory\ProjectDetailsFactory::class
        ],
       'aliases' => [
            'ProjectDetails' => View\Helper\ProjectDetails::class
       ]
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
