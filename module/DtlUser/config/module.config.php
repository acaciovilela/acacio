<?php

namespace DtlUser;

return array(
    'controllers' => array(
        'factories' => array(
            'DtlUser\Controller\User' => function($sm) {
                $sl = $sm->getServiceLocator();
                $controller = new Controller\UserController();
                $controller->setAuthService($sl->get('dtluser_auth_service'));
                $controller->setAuthAdapter($sl->get('dtluser_auth_adapter'));
                $controller->setLoginForm($sl->get('dtluser_login_form'));
                $controller->setUserForm($sl->get('dtluser_user_form'));
                $controller->setUserService($sl->get('dtluser_service'));
                $controller->setEntityManager($sl->get('Doctrine\ORM\EntityManager'));
                return $controller;
            }
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'dtluser_login_form' => function($s) {
                $em = $s->get('doctrine.entitymanager.orm_default');
                $form = new Form\Login($em);
                return $form;
            },
            'dtluser_user_form' => function($s) {
                $em = $s->get('doctrine.entitymanager.orm_default');
                $form = new Form\User($em);
                return $form;
            },
            'dtluser_auth_adapter' => function($s) {
                return $s->get('doctrine.authenticationadapter.orm_default');
            },
            'dtluser_service' => function($sm) {
                $service = new Service\User();
                $service->setAuthService($sm->get('dtluser_auth_service'));
                $service->setEntityManager($sm->get('Doctrine\ORM\EntityManager'));
                return $service;
            }
        ),
        'aliases' => array(
            'Zend\Authentication\AuthenticationService' => 'dtluser_auth_service',
        ),
        'invokables' => array(
            'dtluser_auth_service' => 'Zend\Authentication\AuthenticationService',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dtluser' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'DtlUser\Entity\User',
                'identity_property' => 'username',
                'credential_property' => 'password',
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'dtluser' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        'controller' => 'DtlUser\Controller\User',
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
                    'logout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/logout',
                            'defaults' => array(
                                'action' => 'logout',
                            ),
                        ),
                    ),
                    'register' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/register',
                            'defaults' => array(
                                'action' => 'register',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
