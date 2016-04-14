<?php

namespace DtlAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('dtluser/login');
        }
        return new ViewModel(array());
    }

    public function loginAction() {
        return new ViewModel(array());
    }

}
