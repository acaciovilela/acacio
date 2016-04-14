<?php

namespace DtlUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use DtlPerson\Entity\Person;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int 
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @var int
     */
    protected $isActive;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default":true})
     */
    protected $news;

    /**
     * @ORM\OneToOne(targetEntity="DtlPerson\Entity\Person", cascade={"all"})
     * @var Person
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @var User
     */
    protected $parent;

    public function __construct() {
        $this->person = new Person();
        $this->isActive = true;
        $this->news = true;
    }

    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function getNews() {
        return $this->news;
    }

    function getPerson() {
        return $this->person;
    }

    function getParent() {
        return $this->parent;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
    }

    function setNews($news) {
        $this->news = $news;
        return $this;
    }

    function setPerson(Person $person) {
        $this->person = $person;
        return $this;
    }

    function setParent(User $parent) {
        $this->parent = $parent;
        return $this;
    }

}
