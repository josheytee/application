<?php

namespace app\core\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Routing
 *
 * @ORM\Table(name="Routing")
 * @ORM\Entity(repositoryClass="app\core\entity\repository\RoutingRepository")
 */
class Routing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string")
     */
    private $path;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="route", type="object")
     */
    private $route;


}

