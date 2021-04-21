<?php

namespace Campaigns;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\CampaignController::class => Controller\Factory\CampaignControllerFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'campaign' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/campaign[/:action[/:id][/:campaign_id]]',
                    'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\CampaignController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\CampaignController::class => [
                ['actions' => ['index','add','edit','delete'], 'allow' => '+campaign.manage'],
                ]
            ],
        ],

    'view_manager' => [
        'template_path_stack' => [
            'campaigns' => __DIR__ . '/../view',
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
            View\Helper\CampaignDetail::class => View\Helper\Factory\CampaignDetailFactory::class
        ],
       'aliases' => [
            'CampaignDetail' => View\Helper\CampaignDetail::class
       ]
    ],
    
];
