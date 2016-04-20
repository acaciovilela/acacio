<?php

namespace DtlTwitter\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceLocatorInterface;

class TwitterController extends AbstractActionController {

    protected $serviceLocator;

    public function indexAction() {
        $config = array(
            'access_token' => array(
                'token' => '2654848794-3FkWyhK3q2jGFwme1iJ2jOuSuEhGyXTxhEASCjm',
                'secret' => 'UhuBbrRa7OJ5CPhS2TlZOctFRlTmmqHlTQfL60W607jBx',
            ),
            'oauth_options' => array(
                'consumerKey' => '2vvwfEL3XHbwHaS301lA8tO2h',
                'consumerSecret' => 'TXQWk7iRYcBVnwHCnJ2GBY9BvEqKznU5gaiWXGu5R03KL1WVHn',
            ),
            'http_client_options' => array(
                'adapter' => 'Zend\Http\Client\Adapter\Curl',
                'curloptions' => array(
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false,
                ),
            ),
        );
        
        $twitter = new \ZendService\Twitter\Twitter($config);
        
        $twitter->accountVerifyCredentials();
        
        return new ViewModel();
    }

    function getServiceLocator() {
        return $this->serviceLocator;
    }

    function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

}
