<?php

namespace DtlInstagram\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Instagram extends AbstractHelper {

    protected $instagramService;

    public function __invoke() {
        $service = $this->getInstagramService();
        return $service->getAuthUri();
    }

    function getInstagramService() {
        return $this->instagramService;
    }

    function setInstagramService($instagramService) {
        $this->instagramService = $instagramService;
    }

}
