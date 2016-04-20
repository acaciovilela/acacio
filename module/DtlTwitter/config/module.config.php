<?php

namespace DtlTwitter;

return array(
    'config' => array(
        'access_token' => array(
            'token' => '2654848794-3FkWyhK3q2jGFwme1iJ2jOuSuEhGyXTxhEASCjm',
            'secret' => 'UhuBbrRa7OJ5CPhS2TlZOctFRlTmmqHlTQfL60W607jBx',
        ),
        'oauth_options' => array(
            'consumerKey' => '2vvwfEL3XHbwHaS301lA8tO2h',
            'consumerSecret' => 'TXQWk7iRYcBVnwHCnJ2GBY9BvEqKznU5gaiWXGu5R03KL1WVHn',
        ),
        'http_client_options' => array(
            'adapter' => 'Zend\Http\Client\Adapter\Curl',
            'curloptions' => array(
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'DtlTwitter\Controller\Twitter' => function($sm) {
                $controller = new Controller\TwitterController();
                $controller->setServiceLocator($sm->getServiceLocator());
                return $controller;
            }
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'dtltwitter_service' => function($sm) {
                $config = $sm->get('config');
                $service = new Service\Twitter($config['config']);
                return $service;
            },
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
        ),
        'template_path_stack' => array(
            'dtltwitter' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'dtladmin' => array(
                'child_routes' => array(
                    'dtltwitter' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/twitter',
                            'defaults' => array(
                                'controller' => 'DtlTwitter\Controller\Twitter',
                                'action' => 'index'
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                )
            )
        ),
    ),
);
