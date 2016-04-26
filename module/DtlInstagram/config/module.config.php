<?php

namespace DtlInstagram;

return array(
    'instagram' => array(
        'client_id' => '49c77d8c37bb4dc2a909f192a196531b',
        'client_secret' => '7d8d0a4fa1a54afbb4a973079258dc54',
        'redirect_uri' => 'http://acacio.com/instagram/auth',
        'auth_uri_base' => 'https://api.instagram.com/oauth/authorize/',
    ),
    'controllers' => array(
        'factories' => array(
            'DtlInstagram\Controller\Instagram' => function($sm) {
                $controller = new Controller\InstagramController();
                $controller->setServiceLocator($sm);
                return $controller;
            }
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'dtlInstagramUri' => function($sm) {
                $instagram = new View\Helper\Instagram();
                $service = $sm->getServiceLocator()->get('dtlinstagram_service');
                $instagram->setInstagramService($service);
                return $instagram;
            }
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'dtlinstagram_service' => function($sm) {
                $service = new Service\Instagram();
                $service->setServiceLocator($sm);
                return $service;
            },
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dtlinstagram' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'dtlinstagram' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/instagram',
                    'defaults' => array(
                        'controller' => 'DtlInstagram\Controller\Instagram',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'auth' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/auth',
                            'defaults' => array(
                                'action' => 'auth',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
