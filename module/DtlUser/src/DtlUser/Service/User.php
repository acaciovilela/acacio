<?php

namespace DtlUser\Service;

class User {

    protected $authService;
    protected $authAdapter;
    protected $entityManager;
    
    public function login($post) {
            // \Zend\Debug\Debug::dump($post);exit;

        $authService = $this->getAuthService();
        $authAdapter = $this->getAuthAdapter();
        $authAdapter->setIdentity($post->login['username']);
        $authAdapter->setCredential($post->login['password']);
        $authResult = $authService->authenticate($authAdapter);
        return $authResult;
    }

    public function register($user) {
        $password = $user->getPassword();
        
        $user->setPassword($password);

        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();

        return true;
    }

	public function getAuthAdapter() {
		return $this->authAdapter;
	}
	
	public function setAuthAdapter($authAdapter) {
		$this->authAdapter = $authAdapter;
		return $this;
	}
	
    public function getAuthService() {
        return $this->authService;
    }

    public function setAuthService($authService) {
        $this->authService = $authService;
        return $this;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

}
