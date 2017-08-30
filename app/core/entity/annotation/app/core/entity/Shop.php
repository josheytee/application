<?php

namespace app\core\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shop
 *
 * @ORM\Table(name="Shop", indexes={@ORM\Index(name="url_idx", columns={"url"})})
 * @ORM\Entity(repositoryClass="app\core\entity\repository\ShopRepository")
 */
class Shop
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=32, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=320)
     */
    private $description;

    /**
     * @var \app\core\entity\Activity
     *
     * @ORM\OneToOne(targetEntity="app\core\entity\Activity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_activity", referencedColumnName="id", unique=true)
     * })
     */
    private $activity;

    /**
     * @var \app\core\entity\State
     *
     * @ORM\OneToOne(targetEntity="app\core\entity\State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_state", referencedColumnName="id", unique=true)
     * })
     */
    private $state;


}

