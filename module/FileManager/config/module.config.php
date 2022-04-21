<?php

namespace FileManager;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\FoldersController::class => Controller\Factory\FoldersControllerFactory::class
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'folders' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/folders[/:action[/:file]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\FoldersController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'services' => [
    'file_manager' => [
        'logger' => "C:/wamp64/www/lms/public/error_log.txt",
    ],
        ],
         ],
    'view_helpers' => [
        'factories' => [
            View\Helper\FileFunctions::class => View\Helper\Factory\FileFunctionsFactory::class,
        ],
        'aliases' => [
            'FileFunctions' => View\Helper\FileFunctions::class,
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'controllers' => [
            Controller\FoldersController::class => [
                ['actions' => ['index', 'download', 'delete', 'deleteFile'], 'allow' => '*'],
            ],
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'filemanager' => __DIR__ . '/../view',
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
    'view_helper_config' => [
    'flashmessenger' => [
        'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>',
        'message_close_string'     => '</p></div>',
        'message_separator_string' => '</div><div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'
        ]
    ]

];
