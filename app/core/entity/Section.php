<?php

namespace app\core\entity;

/**
 * Section
 */
class Section
{
    /**
     * @var integer
     */
    private $id = 0;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var Shop
     */
    private $shop;

    /**
     * @var Section
     */
    private $section;
    /**
     * @var SectionImage
     */
    private $image;
    /**
     * @var SectionImage
     */
    private $images;

    public function __construct()
    {
        $this->setSection($this);
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
     * @return Section
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Section
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Section
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Section
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Section
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get shop
     *
     * @return Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set shop
     *
     * @param Shop $shop
     *
     * @return Section
     */
    public function setShop(Shop $shop = null)
    {
        $this->shop = $shop;
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
     * @return Section
     */
    public function setSection(Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
        $this->updated = new \DateTime("now");
    }

    /**
     * @ORM\PostPersist
     */
    public function onPostPersist()
    {
        $this->updated = new \DateTime("now");
    }

    /**
     * Get image
     *
     * @return SectionImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param SectionImage $image
     *
     * @return Section
     */
    public function setImage(SectionImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get images
     *
     * @return SectionImage
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set images
     *
     * @param SectionImage $images
     *
     * @return Section
     */
    public function setImages(SectionImage $images = null)
    {
        $this->images = $images;

        return $this;
    }

    public function hasParent()
    {
        return (bool)$this->section->getId() > 0;
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

    public function isRoot()
    {
        return (bool)$this->section->getId() == 0;
    }

    public function hasChildren()
    {
//        dump($this->name, (bool)$this->section->getId() > 0);
//        return (bool)$this->section->getId() > 0;
    }

//    public function getParent()
//    {
//        return $this->section;
//    }
}
