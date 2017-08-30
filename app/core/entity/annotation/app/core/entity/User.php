<?php

namespace app\core\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="User", indexes={@ORM\Index(name="username_email_phone_idx", columns={"username", "email", "phone"})})
 * @ORM\Entity(repositoryClass="app\core\entity\repository\UserRepository")
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=32)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=32)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=32, nullable=true, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", nullable=true, unique=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=32, unique=true)
     */
    private $phone;


}

