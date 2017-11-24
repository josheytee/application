<?php

namespace app\core\entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * SectionImage
 */
class SectionImage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $width;

    /**
     * @var integer
     */
    private $height;

    /**
     * @var Product
     */
    private $product;
    /**
     * @var Section
     */
    private $section;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->section = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SectionImage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return SectionImage
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return SectionImage
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set product
     *
     * @param Product $product
     *
     * @return SectionImage
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get section
     *
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set section
     *
     * @param Section $section
     *
     * @return SectionImage
     */
    public function setSection(Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Add section
     *
     * @param Section $section
     *
     * @return SectionImage
     */
    public function addSection(Section $section)
    {
        $this->section[] = $section;

        return $this;
    }

    /**
     * Remove section
     *
     * @param Section $section
     */
    public function removeSection(Section $section)
    {
        $this->section->removeElement($section);
    }
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var string
     */
    private $size;

    /**
     * @var string
     */
    private $oneToMany;


    /**
     * Set path
     *
     * @param string $path
     *
     * @return SectionImage
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return SectionImage
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return SectionImage
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set oneToMany
     *
     * @param string $oneToMany
     *
     * @return SectionImage
     */
    public function setOneToMany($oneToMany)
    {
        $this->oneToMany = $oneToMany;

        return $this;
    }

    /**
     * Get oneToMany
     *
     * @return string
     */
    public function getOneToMany()
    {
        return $this->oneToMany;
    }

    public function path()
    {
        return '/var/www/html/application/extensions/modules/ntc/section/1/images/';
    }
}
