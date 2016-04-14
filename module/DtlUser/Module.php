<?php

namespace DtlUser;

use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

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

    public function onBootstrap(EventInterface $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'selectLayout'));
    }

    public function selectLayout(MvcEvent $e) {
        $match = $e->getRouteMatch()->getMatchedRouteName();
        if ($match === 'dtluser/login') {
            $controller = $e->getTarget();
            $controller->layout('layout/login');
            return;
        } elseif ($match === 'dtluser/profile') {
            $controller = $e->getTarget();
            $controller->layout('layout/admin');
            return;
        } elseif ($match === 'dtluser/logout') {
            $controller = $e->getTarget();
            $controller->layout('layout/admin');
            return;
        } elseif ($match === 'dtluser/register') {
            $controller = $e->getTarget();
            $controller->layout('layout/admin');
            return;
        }
    }
}
