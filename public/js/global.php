<?php
return array(
    'session_config' => array(
        'cookie_lifetime' => 3600,
        'gc_maxlifetime' => 2592000,
    ),
    'session_manager' => array(
        'validators' => array(
            0 => 'Zend\\Session\\Validator\\RemoteAddr',
            1 => 'Zend\\Session\\Validator\\HttpUserAgent',
        ),
    ),
    'session_storage' => array(
        'type' => 'Zend\\Session\\Storage\\SessionArrayStorage',
    ),
    'caches' => array(
        'FilesystemCache' => array(
            'adapter' => array(
                'name' => 'Zend\\Cache\\Storage\\Adapter\\Filesystem',
                'options' => array(
                    'cache_dir' => './data/cache',
                    'ttl' => 3600,
                ),
            ),
            'plugins' => array(
                0 => array(
                    'name' => 'serializer',
                    'options' => array(),
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'migrations_configuration' => array(
            'orm_default' => array(
                'directory' => 'data/Migrations',
                'name' => 'Doctrine Database Migrations',
                'namespace' => 'Migrations',
                'table' => 'migrations',
            ),
        ),
    ),
    'zf-content-negotiation' => array(
        'selectors' => array(),
    ),
    'db' => array(
        'adapters' => array(
            'API_DB' => array(),
        ),
    ),
    'router' => array(
        'routes' => array(
            'oauth' => array(
                'options' => array(
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(oauth))',
                ),
                'type' => 'regex',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'map' => array(
                'Super\\V1' => 'oauth2',
            ),
        ),
    ),
    'translator' => [
    'locale' => 'en',
    'translation_file_patterns' => [
        [
            'type'     => 'gettext',
            'base_dir' => getcwd() .  '/data/language',
            'pattern'  => '%s.mo',
        ],
    ],
],
	'service_manager' => [
        'services' => [
	'file_manager' => [
		'upload_dir' => "C:\wamp64\www\connectCRM\public\uploads",
	],
        ],
		 ],
);
