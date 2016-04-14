<?php

namespace DtlUser\Service;

class User {

    protected $authService;
    protected $entityManager;

    public function register($user) {

        $bcrypt = new \Zend\Crypt\Password\Bcrypt();
        $bcrypt->setCost(14);
        $password = $bcrypt->create($user->getPassword());
        $user->setPassword($password);
        
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
        
        return true;
    }

    function getAuthService() {
        return $this->authService;
    }

    function setAuthService($authService) {
        $this->authService = $authService;
        return $this;
    }

    function getEntityManager() {
        return $this->entityManager;
    }

    function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

}
