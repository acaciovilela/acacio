<?php

namespace DtlAdmin;

return array(
    'controllers' => array(
        'invokables' => array(
            'DtlAdmin\Controller\Index' => 'DtlAdmin\Controller\IndexController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'admin' => 'DtlAdmin\Navigation\Service\NavigationFactory',
        ),
    ),
    'navigation' => array(
        'dtladmin' => array()
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dtladmin' => __DIR__ . '/../view',
        ),
    ),
    'dtladmin' => array(
        'use_admin_layout' => true,
        'admin_layout_template' => 'layout/admin',
    ),
    'router' => array(
        'routes' => array(
            'dtladmin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'DtlAdmin\Controller\Index',
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
                ),
            ),
        ),
    ),
);
