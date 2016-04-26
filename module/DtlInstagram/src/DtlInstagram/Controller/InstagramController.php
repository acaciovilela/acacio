<?php

namespace DtlInstagram\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class InstagramController extends AbstractActionController {

    protected $serviceLocator;

    public function indexAction() {
        return new ViewModel();
    }

    public function authAction() {
        $code = $this->params()->fromQuery('code');
        $instagramService = $this->getServiceLocator()->get('dtlinstagram_service');
        $result = $instagramService->authenticate($code);
        if (!$result) {
            return $this->redirect()->toRoute('dtluser/login');
        }
        
        return $this->redirect()->toRoute('dtluser/profile');
    }

    function getServiceLocator() {
        return $this->serviceLocator;
    }

    function setServiceLocator($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

}
