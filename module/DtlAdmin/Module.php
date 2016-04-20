<?php

namespace DtlAdmin;

use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;
use Zend\Mvc\Router\RouteMatch;
use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface, BootstrapListenerInterface {

    public function getAutoloaderConfig() {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @{inheritdoc}
     */
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'admin_navigation' => 'DtlAdmin\Navigation\Service\NavigationFactory',
            ),
        );
    }

    /**
     * @{inheritdoc}
     */
    public function onBootstrap(EventInterface $e) {
        $app = $e->getParam('application');
        $em = $app->getEventManager();

        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'selectLayoutBasedOnRoute'));
    }

    /**
     * Select the admin layout based on route name
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function selectLayoutBasedOnRoute(MvcEvent $e) {
        $app = $e->getParam('application');
        $sm = $app->getServiceManager();
        $config = $sm->get('config');

        if (false === $config['dtladmin']['use_admin_layout']) {
            return;
        }
        
        $match = $e->getRouteMatch();
        $controller = $e->getTarget();
        if (!$match instanceof RouteMatch || 0 !== strpos($match->getMatchedRouteName(), 'dtladmin') || $controller->getEvent()->getResult()->terminate()) {
            return;
        }
        $layout = $config['dtladmin']['admin_layout_template'];
        $controller->layout($layout);
    }

}
