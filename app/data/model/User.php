<?php

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

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
    protected $id_user;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $firstname;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $lastname;

    /**
     * @var string
     *
     * @Column(type="string",unique=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $password;

    /**
     * @var string
     *
     * @Column(type="string",nullable=true)
     */
    protected $remember_token;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $email;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $phone;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @var Shop
     *
     * @OneToMany(targetEntity="Occupation", mappedBy="user", cascade={"remove"})
     */
    protected $occupations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->occupations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set rememberToken
     *
     * @param string $rememberToken
     *
     * @return User
     */
    public function setRememberToken($rememberToken)
    {
        $this->remember_token = $rememberToken;

        return $this;
    }

    /**
     * Get rememberToken
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add occupation
     *
     * @param \Occupation $occupation
     *
     * @return User
     */
    public function addOccupation(\Occupation $occupation)
    {
        $this->occupations[] = $occupation;

        return $this;
    }

    /**
     * Remove occupation
     *
     * @param \Occupation $occupation
     */
    public function removeOccupation(\Occupation $occupation)
    {
        $this->occupations->removeElement($occupation);
    }

    /**
     * Get occupations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOccupations()
    {
        return $this->occupations;
    }
}
