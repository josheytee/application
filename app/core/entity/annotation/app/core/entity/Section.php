<?php

namespace app\core\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Section
 *
 * @ORM\Table(name="Section", indexes={@ORM\Index(name="section_url_idx", columns={"id", "url"})})
 * @ORM\Entity(repositoryClass="app\core\entity\repository\SectionRepository")
 */
class Section
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
     * @ORM\Column(name="url", type="string", nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=320)
     */
    private $description;

    /**
     * @var \app\core\entity\Shop
     *
     * @ORM\OneToOne(targetEntity="app\core\entity\Shop")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_shop", referencedColumnName="id", unique=true)
     * })
     */
    private $shop;

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

