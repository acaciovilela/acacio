<?php

namespace DtlUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserController extends AbstractActionController {

    protected $invalidData = 'Falha na autenticação do usuário.';
    protected $authService;
    protected $authAdapter;
    protected $userForm;
    protected $loginForm;
    protected $userService;
    protected $entityManager;
    protected $serviceLocator;

    public function indexAction() {
        if (!$this->identity()) {
            $this->redirect()->toRoute('dtluser/login');
        } else {
            $this->redirect()->toRoute('dtladmin');
        }
        return new ViewModel();
    }

    public function loginAction() {
        if ($this->identity()) {
            return $this->redirect()->toRoute('dtluser');
        }

        $form = $this->getLoginForm();

        if (!$this->request->isPost()) {
            return new ViewModel(array(
                'form' => $form,
            ));
        }

        $data['login'] = $this->request->getPost();

        $form->setData($data);

        if (!$form->isValid()) {
            $this->flashMessenger()->setNamespace('dtluser-login-form')->addMessage($this->invalidData);
            return $this->redirect()->toRoute('dtluser/login');
        }

        return $this->forward()->dispatch('DtlUser\Controller\User', array('action' => 'authenticate'));
    }

    public function authenticateAction() {
        if ($this->identity()) {
            return $this->redirect()->toRoute('dtluser/login');
        }

        $post = $this->request->getPost();

        $authService = $this->getAuthService();
        $authAdapter = $this->getAuthAdapter();
        $authAdapter->setIdentity($post->username);
        $authAdapter->setCredential($post->password);
        $authResult = $authService->authenticate($authAdapter);

        if (!$authResult->isValid()) {
            $this->flashMessenger()->addMessage($this->invalidData);
            return $this->redirect()->toRoute('dtluser/login');
        }

        return $this->redirect()->toRoute('dtluser/profile');
    }

    public function logoutAction() {
        $auth = $this->getAuthService();
        $auth->clearIdentity();
        return $this->redirect()->toRoute('dtluser/login');
    }

    public function profileAction() {

        $twitter = $this->getServiceLocator()->get('dtltwitter_service');
        $response = $twitter->accountVerifyCredentials();
        if ($response->isSuccess()) {
            $twUser = $response->toValue();
        }
        $auth = $this->getAuthService();
        return new ViewModel(array(
            'identity' => $auth->getIdentity(),
            'twitter' => ($twUser) ? $twUser : null,
        ));
    }

    public function registerAction() {

        if ($this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('dtluser/profile');
        }

        $form = $this->getUserForm();
        $user = new \DtlUser\Entity\User();
        $form->bind($user);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getUserService();
                if ($service->register($user)) {
                    return $this->redirect()->toRoute('dtluser/login');
                }
            }
        }

        return new ViewModel(array(
            'form' => $form
        ));
    }

    function getAuthService() {
        return $this->authService;
    }

    function getInvalidData() {
        return $this->invalidData;
    }

    function setAuthService($authService) {
        $this->authService = $authService;
        return $this;
    }

    function setInvalidData($invalidData) {
        $this->invalidData = $invalidData;
        return $this;
    }

    function getAuthAdapter() {
        return $this->authAdapter;
    }

    function setAuthAdapter($authAdapter) {
        $this->authAdapter = $authAdapter;
        return $this;
    }

    function getUserForm() {
        return $this->userForm;
    }

    function getLoginForm() {
        return $this->loginForm;
    }

    function setUserForm($userForm) {
        $this->userForm = $userForm;
        return $this;
    }

    function setLoginForm($loginForm) {
        $this->loginForm = $loginForm;
        return $this;
    }

    function getUserService() {
        return $this->userService;
    }

    function setUserService($userService) {
        $this->userService = $userService;
        return $this;
    }

    function getEntityManager() {
        return $this->entityManager;
    }

    function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

    function getServiceLocator() {
        return $this->serviceLocator;
    }

    function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

}
