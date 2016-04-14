<?php

namespace DtlFacebook;

use Zend\EventManager\EventInterface;
use Facebook\Facebook;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'dtlfacebook_service' => function ($sm) {
                    $config = $sm->get('config');
                    $fb = new Facebook([
                        'app_id' => $config['config']['app_id'],
                        'app_secret' => $config['config']['app_secret'],
                        'default_graph_version' => $config['config']['default_graph_version']
                    ]);
                    $token = $config['config']['user_access_token'];
                    $userId = $config['config']['user_id'];
                    $pageId = $config['config']['page_id'];
                    $service = new \DtlFacebook\Service\Facebook();
                    $service->setConnection($fb)
                            ->setUserId($userId)
                            ->setPageId($pageId)
                            ->setToken($token)
                            ->setServiceManager($sm);
                    return $service;
                },
            ),
        );
    }
}
        