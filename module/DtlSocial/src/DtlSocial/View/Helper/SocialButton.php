<?php

namespace DtlSocial\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SocialButton extends AbstractHelper {

    /**
     *
     * @var array
     */
    protected $configs;
    protected $provider;

    public function __invoke($provider) {

        if (!$provider) {
            return false;
        }

        $this->setProvider($provider);

        $configs = $this->getConfigs();

        $url = $this->getView()->url("dtlsocial/login");

        $button = '<a href="' . $url . '?provider=' . $provider . '" '
                . 'class="' . $configs['class'] . '">' . $configs['icon']
                . ' Entrar com ' . $provider . '</a>';

        return $button;
    }

    public function getConfigs() {
        $provider = $this->getProvider();

        switch ($provider) {
            case "Twitter":
                $this->configs['class'] = "btn btn-info btn-block";
                break;
            case "Facebook":
                $this->configs['class'] = "btn btn-primary btn-block";
                break;
            case "Instagram":
                $this->configs['class'] = "btn btn-primary btn-block";
                break;
            case "Google":
                $this->configs['class'] = "btn btn-danger btn-block";
                break;
            default:
                $this->configs['class'] = "btn btn-default btn-block";
                break;
        }
        $this->configs['icon'] = "<i class='fa fa-" . lcfirst($provider) . "'></i> ";
        
        return $this->configs;
    }

    public function setConfigs($configs) {
        $this->configs = $configs;
        return $this;
    }

    public function getProvider() {
        return $this->provider;
    }

    public function setProvider($provider) {
        $this->provider = $provider;
        return $this;
    }

}
