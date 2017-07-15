<?php

namespace model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use model\Occupation;

/**
 * User entity
 *
 * @Entity(repositoryClass="UserRepository")
 * @Table(indexes={
 * @Index(name="username_email_phone_idx",  columns={"username","email","phone"})
 * })
 */
class User {

  /**
   * @var int
   *
   * @Id
   * @GeneratedValue
   * @Column(type="integer")
   */
  public $id_user;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $firstname;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $lastname;

  /**
   * @var string
   *
   * @Column(type="string",unique=true,nullable=true)
   */
  public $username;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $password;

  /**
   * @var string
   *
   * @Column(type="string",nullable=true)
   */
  public $remember_token;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $email;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $phone;

  /**
   * @var \DateTime
   *
   * @Column(type="datetime")
   */
  public $created;

  /**
   * @var \DateTime
   *
   * @Column(type="datetime")
   */
  public $updated;

  /**
   * @var Occupation
   *
   * @OneToMany(targetEntity="Occupation", mappedBy="user", cascade={"persist","remove"},orphanRemoval=TRUE)
   */
  public $occupations;

  /**
   * @var router[]
   *
   * @ManyToMany(targetEntity="Router", mappedBy="user")
   */
  protected $router;

  /**
   * @OneToOne(targetEntity="Config")
   * @JoinColumn(name="id_config",referencedColumnName="id_config")
   */
  public $config;

  /**
   * Constructor
   */
  public function __construct() {
    $this->occupations = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Get idUser
   *
   * @return integer
   */
  public function getIdUser() {
    return $this->id_user;
  }

  /**
   * Set firstname
   *
   * @param string $firstname
   *
   * @return User
   */
  public function setFirstname($firstname) {
    $this->firstname = $firstname;

    return $this;
  }

  /**
   * Get firstname
   *
   * @return string
   */
  public function getFirstname() {
    return $this->firstname;
  }

  /**
   * Set lastname
   *
   * @param string $lastname
   *
   * @return User
   */
  public function setLastname($lastname) {
    $this->lastname = $lastname;

    return $this;
  }

  /**
   * Get lastname
   *
   * @return string
   */
  public function getLastname() {
    return $this->lastname;
  }

  /**
   * Set username
   *
   * @param string $username
   *
   * @return User
   */
  public function setUsername($username) {
    $this->username = $username;

    return $this;
  }

  /**
   * Get username
   *
   * @return string
   */
  public function getUsername() {
    return $this->username;
  }

  /**
   * Set password
   *
   * @param string $password
   *
   * @return User
   */
  public function setPassword($password) {
    $this->password = $password;

    return $this;
  }

  /**
   * Get password
   *
   * @return string
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Set rememberToken
   *
   * @param string $rememberToken
   *
   * @return User
   */
  public function setRememberToken($rememberToken) {
    $this->remember_token = $rememberToken;

    return $this;
  }

  /**
   * Get rememberToken
   *
   * @return string
   */
  public function getRememberToken() {
    return $this->remember_token;
  }

  /**
   * Set email
   *
   * @param string $email
   *
   * @return User
   */
  public function setEmail($email) {
    $this->email = $email;

    return $this;
  }

  /**
   * Get email
   *
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Set phone
   *
   * @param string $phone
   *
   * @return User
   */
  public function setPhone($phone) {
    $this->phone = $phone;

    return $this;
  }

  /**
   * Get phone
   *
   * @return string
   */
  public function getPhone() {
    return $this->phone;
  }

  /**
   * Add occupation
   *
   * @param \Occupation $occupation
   *
   * @return User
   */
  public function addOccupation(Occupation $occupation) {
//        $this->occupations[] = $occupation;
    if (!$this->occupations->contains($occupation)) {
      $this->occupations->add($occupation);
      $occupation->setUser($this);
    }
    return $this;
  }

  /**
   * Remove occupation
   *
   * @param \Occupation $occupation
   */
  public function removeOccupation(Occupation $occupation) {
//        $this->occupations->removeElement($occupation);
    if (!$this->occupations->contains($occupation)) {
      $this->occupations->removeElement($occupation);
      $occupation->setUser(null);
    }
    return $this;
  }

  public function getShops() {
    return array_map(
            function ($occupation) {
      return $occupation->getCompany();
    }, $this->occupations->toArray()
    );
  }

  /**
   * Get occupations
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getOccupations() {
    return $this->occupations;
  }

  /**
   * Set created
   *
   * @param \DateTime $created
   *
   * @return User
   */
  public function setCreated($created) {
    $this->created = $created;

    return $this;
  }

  /**
   * Get created
   *
   * @return \DateTime
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Set updated
   *
   * @param \DateTime $updated
   *
   * @return User
   */
  public function setUpdated($updated) {
    $this->updated = $updated;

    return $this;
  }

  /**
   * Get updated
   *
   * @return \DateTime
   */
  public function getUpdated() {
    return $this->updated;
  }

  /**
   * Set config
   *
   * @param \model\Config $config
   *
   * @return User
   */
  public function setConfig(\model\Config $config = null) {
    $this->config = $config;

    return $this;
  }

  /**
   * Get config
   *
   * @return \model\Config
   */
  public function getConfig() {
    return $this->config;
  }


    /**
     * Add router
     *
     * @param \model\Router $router
     *
     * @return User
     */
    public function addRouter(\model\Router $router)
    {
        $this->router[] = $router;

        return $this;
    }

    /**
     * Remove router
     *
     * @param \model\Router $router
     */
    public function removeRouter(\model\Router $router)
    {
        $this->router->removeElement($router);
    }

    /**
     * Get router
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRouter()
    {
        return $this->router;
    }
}
