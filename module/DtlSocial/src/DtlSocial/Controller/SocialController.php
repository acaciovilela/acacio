<?php

namespace DtlSocial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hybridauth\Hybridauth;

class SocialController extends AbstractActionController {

    protected $serviceLocator;
    protected $userProfile;
    protected $adapter;

    public function indexAction() {
        return new ViewModel();
    }

    public function loginAction() {
        $provider = $this->params()->fromQuery('provider');

        $config = $this->getServiceLocator()->get('config');

        $auth = new Hybridauth($config['hybridconfig']);

        $adapter = $auth->authenticate($provider);

        \Zend\Debug\Debug::dump($adapter->getUserProfile());exit;
        
        return new ViewModel();
    }

    public function profileAction() {
        $adapter = Hybrid_Auth::getAdapter();
        
        
        return new ViewModel();
    }

    public function getUserProfile() {
        return $this->userProfile;
    }

    public function getAdapter() {
        return $this->adapter;
    }

    public function setUserProfile($userProfile) {
        $this->userProfile = $userProfile;
        return $this;
    }

    public function setAdapter($adapter) {
        $this->adapter = $adapter;
        return $this;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

}
