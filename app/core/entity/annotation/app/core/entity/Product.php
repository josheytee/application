<?php

namespace app\core\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="Product", indexes={@ORM\Index(name="product_price_name_idx", columns={"id", "price", "name"})})
 * @ORM\Entity(repositoryClass="app\core\entity\repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="short_description", type="text", length=320)
     */
    private $short_description;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=700)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="condition", type="string")
     */
    private $condition = 'new';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type = 'simple';

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", scale=4)
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_price", type="boolean")
     */
    private $show_price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="online_only", type="boolean")
     */
    private $online_only;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \app\core\entity\Section
     *
     * @ORM\OneToOne(targetEntity="app\core\entity\Section")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_section", referencedColumnName="id", unique=true)
     * })
     */
    private $section;


}

