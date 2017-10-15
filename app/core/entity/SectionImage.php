<?php

namespace app\core\entity;

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
     * @var \app\core\entity\Product
     */
    private $product;


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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
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
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set product
     *
     * @param \app\core\entity\Product $product
     *
     * @return SectionImage
     */
    public function setProduct(\app\core\entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \app\core\entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
    /**
     * @var \app\core\entity\Section
     */
    private $section;


    /**
     * Set section
     *
     * @param \app\core\entity\Section $section
     *
     * @return SectionImage
     */
    public function setSection(\app\core\entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \app\core\entity\Section
     */
    public function getSection()
    {
        return $this->section;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->section = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add section
     *
     * @param \app\core\entity\Section $section
     *
     * @return SectionImage
     */
    public function addSection(\app\core\entity\Section $section)
    {
        $this->section[] = $section;

        return $this;
    }

    /**
     * Remove section
     *
     * @param \app\core\entity\Section $section
     */
    public function removeSection(\app\core\entity\Section $section)
    {
        $this->section->removeElement($section);
    }
}
