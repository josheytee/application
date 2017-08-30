<?php

namespace app\core\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="Role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var \app\core\entity\User
     *
     * @ORM\OneToOne(targetEntity="app\core\entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_admin", referencedColumnName="id", unique=true)
     * })
     */
    private $admin;


}

