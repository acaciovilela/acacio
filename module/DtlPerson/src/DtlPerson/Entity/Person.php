<?php

namespace DtlPerson\Entity;

use Doctrine\ORM\Mapping as ORM;
use DtlPerson\Entity\Address as AddressEntity;
use DtlPerson\Entity\Contact as ContactEntity;
use DtlPerson\Entity\Individual as IndividualEntity;
use DtlPerson\Entity\Legal as LegalEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person {

    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $lastName;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var bool
     */
    protected $type;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var date
     */
    protected $date;

    /**
     * @ORM\Column(type="boolean", name="is_active", nullable=false)
     * @var bool
     */
    protected $isActive;

    /**
     * @ORM\OneToOne(targetEntity="DtlPerson\Entity\Address", cascade={"all"})
     * @var \DtlPerson\Entity\Address
     */
    protected $address;

    /**
     * @ORM\OneToOne(targetEntity="DtlPerson\Entity\Contact", cascade={"all"})
     * @var \DtlPerson\Entity\Contact
     */
    protected $contact;

    /**
     * @ORM\OneToOne(targetEntity="DtlPerson\Entity\Individual", cascade={"all"})
     * @var \DtlPerson\Entity\Individual
     */
    protected $individual;

    /**
     * @ORM\OneToOne(targetEntity="DtlPerson\Entity\Legal", cascade={"all"})
     * @var \DtlPerson\Entity\Legal
     */
    protected $legal;

    public function __construct() {
        $this->type = false;
        $this->isActive = true;
        $this->date = new \DateTime('now');
        $this->address = new AddressEntity();
        $this->contact = new ContactEntity();
        $this->individual = new IndividualEntity();
        $this->legal = new LegalEntity();
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getType() {
        return $this->type;
    }

    function getDate() {
        return $this->date;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function getAddress() {
        return $this->address;
    }

    function getContact() {
        return $this->contact;
    }

    function getIndividual() {
        return $this->individual;
    }

    function getLegal() {
        return $this->legal;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    function setType($type) {
        $this->type = $type;
        return $this;
    }

    function setDate($date) {
        $this->date = $date;
        return $this;
    }

    function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
    }

    function setAddress(AddressEntity $address) {
        $this->address = $address;
        return $this;
    }

    function setContact(ContactEntity $contact) {
        $this->contact = $contact;
        return $this;
    }

    function setIndividual(IndividualEntity $individual) {
        $this->individual = $individual;
        return $this;
    }

    function setLegal(LegalEntity $legal) {
        $this->legal = $legal;
        return $this;
    }

}
