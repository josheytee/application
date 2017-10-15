<?php

namespace app\core\entity;

/**
 * Section
 */
class Section {
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

    public function __construct() {
        $this->setSection($this);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Section
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Section
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Section
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Section
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Section
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Set shop
     *
     * @param Shop $shop
     *
     * @return Section
     */
    public function setShop(Shop $shop = null) {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return Shop
     */
    public function getShop() {
        return $this->shop;
    }

    /**
     * Set section
     *
     * @param Section $section
     *
     * @return Section
     */
    public function setSection(Section $section = null) {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return Section
     */
    public function getSection() {
        return $this->section;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist() {
        $this->created = new \DateTime("now");
        $this->updated = new \DateTime("now");
    }

    /**
     * @ORM\PostPersist
     */
    public function onPostPersist() {
        $this->updated = new \DateTime("now");
    }
    /**
     * @var SectionImage
     */
    private $image;


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
     * Get image
     *
     * @return SectionImage
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @var \app\core\entity\SectionImage
     */
    private $images;


    /**
     * Set images
     *
     * @param \app\core\entity\SectionImage $images
     *
     * @return Section
     */
    public function setImages(\app\core\entity\SectionImage $images = null)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return \app\core\entity\SectionImage
     */
    public function getImages()
    {
        return $this->images;
    }
}
