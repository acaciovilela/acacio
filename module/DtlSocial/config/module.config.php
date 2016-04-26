<?php

namespace DtlSocial;

return array(
    'controllers' => array(
        'factories' => array(
            'DtlSocial\Controller\Social' => function($sm) {
                $controller = new Controller\SocialController();
                $controller->setServiceLocator($sm);
                return $controller;
            },
        ),
    ),
    'view_manager' => array(
         'template_path_stack' => array(
             'dtlsocial' => __DIR__ . '/../view',
         ),
     ),
    'view_helpers' => array(
        'factories' => array(
            'dtlSocialButton' => function($sm) {
                $button = new View\Helper\SocialButton();
                return $button;
            }
        ),
    ),
    'router' => array(
        'routes' => array(
            'dtlsocial' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/social',
                    'defaults' => array(
                        'controller' => 'DtlSocial\Controller\Social',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/login',
                            'defaults' => array(
                                'action' => 'login',
                            ),
                        ),
                    ),
                    'profile' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/profile',
                            'defaults' => array(
                                'action' => 'profile',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
