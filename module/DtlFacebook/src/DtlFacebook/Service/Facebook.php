<?php

namespace DtlFacebook\Service;


class Facebook {

    protected $userId;
    protected $pageId;
    protected $connection;
    protected $token;
    protected $serviceManager;

    public function __construct() {
        
    }

    public function getId() {
        $fb = $this->getConnection();
        $response = $fb->get('/'. $this->getPageId() . '', $this->getToken());
        $data = $response->getDecodedBody();
        return $data['id'];
    }
    
    public function getName() {
        $fb = $this->getConnection();
        $response = $fb->get('/'. $this->getPageId() . '', $this->getToken());
        $data = $response->getDecodedBody();
        return $data['name'];
    }
    
    public function getFeaturedVideo() {
        $fb = $this->getConnection();
        $response = $fb->get('/'. $this->getPageId() . '?fields=featured_video', $this->getToken());
        $data = $response->getDecodedBody();
        $response = $fb->get('/'. $data['featured_video']['id'] . '?fields=embed_html', $this->getToken());
        $data = $response->getDecodedBody();
        return $data['embed_html'];
    }

    function getUserId() {
        return $this->userId;
    }

    function getPageId() {
        return $this->pageId;
    }

    function getConnection() {
        return $this->connection;
    }

    function getToken() {
        return $this->token;
    }

    function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    function setPageId($pageId) {
        $this->pageId = $pageId;
        return $this;
    }

    function setConnection($connection) {
        $this->connection = $connection;
        return $this;
    }

    function setToken($token) {
        $this->token = $token;
        return $this;
    }
    
    function getServiceManager() {
        return $this->serviceManager;
    }

    function setServiceManager($serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}
