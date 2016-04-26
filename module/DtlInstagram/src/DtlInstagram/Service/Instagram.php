<?php

namespace DtlInstagram\Service;

use Zend\Http\Client;
use Zend\Json\Json;

class Instagram {

    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $authUriBase;
    protected $authUri;
    protected $configs;
    protected $serviceLocator;

    public function __construct() {
        
    }

    public function authenticate($code) {
        if (!isset($code)) {
            return print "Erro de authenticação.";
        }

        $response = $this->getHttpRequest('https://api.instagram.com/oauth/access_token', $code);

        if (isset($response) && $response->isSuccess()) {
            $user = Json::decode($response->getBody());
            return $user;
        }

        return false;
    }
    
    public function getHttpRequest($uri, $code) {
        $client = new Client();
        $client->setUri($uri);
        $client->setMethod('POST');
        $client->setParameterPost(array(
            'client_id' => $this->getClientId(),
            'client_secret' => $this->getClientSecret(),
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->getRedirectUri(),
            'code' => $code,
        ));
        
        $result = $client->send();
        
        if ($result) {
            return $result;
        }
        
        return false;
    }

    public function getClientId() {
        if (!$this->clientId) {
            $configs = $this->getConfigs();
            $this->setClientId($configs['client_id']);
        }
        return $this->clientId;
    }

    public function getClientSecret() {
        if (!$this->clientSecret) {
            $configs = $this->getConfigs();
            $this->setClientSecret($configs['client_secret']);
        }
        return $this->clientSecret;
    }

    public function getRedirectUri() {
        if (!$this->redirectUri) {
            $configs = $this->getConfigs();
            $this->setRedirectUri($configs['redirect_uri']);
        }
        return $this->redirectUri;
    }

    public function getAuthUriBase() {
        if (!$this->authUriBase) {
            $configs = $this->getConfigs();
            $this->setAuthUriBase($configs['auth_uri_base']);
        }
        return $this->authUriBase;
    }

    public function getAuthUri() {
        $authUri = $this->getAuthUriBase() . "?client_id=" . $this->getClientId() . "&redirect_uri=" . $this->getRedirectUri() . "&response_type=code";
        return $authUri;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
        return $this;
    }

    public function setClientSecret($clientSecret) {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function setRedirectUri($redirectUri) {
        $this->redirectUri = $redirectUri;
        return $this;
    }

    public function setServiceLocator($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function setAuthUriBase($authUriBase) {
        $this->authUriBase = $authUriBase;
        return $this;
    }

    public function setAuthUri($authUri) {
        $this->authUri = $authUri;
        return $this;
    }

    public function getConfigs() {
        if (!$this->configs) {
            $configs = $this->getServiceLocator()->get('config');
            $this->setConfigs($configs['instagram']);
        }
        return $this->configs;
    }

    public function setConfigs($configs) {
        $this->configs = $configs;
        return $this;
    }

}
