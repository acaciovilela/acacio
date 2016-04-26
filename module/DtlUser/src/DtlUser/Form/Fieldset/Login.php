<?php

namespace DtlUser\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class Login extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('login');

        $this->setHydrator(new DoctrineHydrator($entityManager));

        $this->add(array(
            'name' => 'username',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Usuário',
                'class' => 'form-control',
                'id' => 'username'
            ),
            'options' => array(
                'label' => 'Usuário',
            )
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'placeholder' => 'Senha',
                'class' => 'form-control',
                'autocomplete' => 'off',
                'id' => 'password'
            ),
            'options' => array(
                'label' => 'Senha',
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'username' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            ),
        );
    }

}
