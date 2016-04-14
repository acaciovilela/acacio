<?php

namespace DtlUser\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DtlUser\Entity\User as UserEntity;

class Login extends Form {

    public function __construct($entityManager) {

        parent::__construct('login');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager))
                ->setInputFilter(new InputFilter());
        
        $user = new Fieldset\Login($entityManager);
        $user->setUseAsBaseFieldset(true);
        $this->add($user);

        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Entrar',
                'class' => 'btn btn-primary'
            )
        ));
    }
}
