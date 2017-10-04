<?php

namespace app\core\entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Product
 */
class Product {
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $shortDescription;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $condition = 'new';

    /**
     * @var string
     */
    private $type = 'simple';

    /**
     * @var boolean
     */
    private $available = false;

    /**
     * @var string
     */
    private $price;

    /**
     * @var boolean
     */
    private $showPrice = false;

    /**
     * @var boolean
     */
    private $onlineOnly = false;

    /**
     * @var string
     */
    private $wholesalePrice;

    /**
     * @var string
     */
    private $metaTitle;

    /**
     * @var string
     */
    private $metaDescription;

    /**
     * @var array
     */
    private $metaKeywords;

    /**
     * @var string
     */
    private $linkRewrite;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var string
     */
    private $quantityDiscount;

    /**
     * @var integer
     */
    private $minimalQuantity;

    /**
     * @var boolean
     */
    private $active = false;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var Collection
     */
    private $images;

    /**
     * @var Section
     */
    private $section;

    /**
     * Constructor
     */
    public function __construct() {
        $this->images = new ArrayCollection();
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
     * @return Product
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
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return Product
     */
    public function setShortDescription($shortDescription) {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription() {
        return $this->shortDescription;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set condition
     *
     * @param string $condition
     *
     * @return Product
     */
    public function setCondition($condition) {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return string
     */
    public function getCondition() {
        return $this->condition;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Product
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return Product
     */
    public function setAvailable($available) {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable() {
        return $this->available;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set showPrice
     *
     * @param boolean $showPrice
     *
     * @return Product
     */
    public function setShowPrice($showPrice) {
        $this->showPrice = $showPrice;

        return $this;
    }

    /**
     * Get showPrice
     *
     * @return boolean
     */
    public function getShowPrice() {
        return $this->showPrice;
    }

    /**
     * Set onlineOnly
     *
     * @param boolean $onlineOnly
     *
     * @return Product
     */
    public function setOnlineOnly($onlineOnly) {
        $this->onlineOnly = $onlineOnly;

        return $this;
    }

    /**
     * Get onlineOnly
     *
     * @return boolean
     */
    public function getOnlineOnly() {
        return $this->onlineOnly;
    }

    /**
     * Set wholesalePrice
     *
     * @param string $wholesalePrice
     *
     * @return Product
     */
    public function setWholesalePrice($wholesalePrice) {
        $this->wholesalePrice = $wholesalePrice;

        return $this;
    }

    /**
     * Get wholesalePrice
     *
     * @return string
     */
    public function getWholesalePrice() {
        return $this->wholesalePrice;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return Product
     */
    public function setMetaTitle($metaTitle) {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle() {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Product
     */
    public function setMetaDescription($metaDescription) {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription() {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param array $metaKeywords
     *
     * @return Product
     */
    public function setMetaKeywords($metaKeywords) {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return array
     */
    public function getMetaKeywords() {
        return $this->metaKeywords;
    }

    /**
     * Set linkRewrite
     *
     * @param string $linkRewrite
     *
     * @return Product
     */
    public function setLinkRewrite($linkRewrite) {
        $this->linkRewrite = $linkRewrite;

        return $this;
    }

    /**
     * Get linkRewrite
     *
     * @return string
     */
    public function getLinkRewrite() {
        return $this->linkRewrite;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Set quantityDiscount
     *
     * @param string $quantityDiscount
     *
     * @return Product
     */
    public function setQuantityDiscount($quantityDiscount) {
        $this->quantityDiscount = $quantityDiscount;

        return $this;
    }

    /**
     * Get quantityDiscount
     *
     * @return string
     */
    public function getQuantityDiscount() {
        return $this->quantityDiscount;
    }

    /**
     * Set minimalQuantity
     *
     * @param integer $minimalQuantity
     *
     * @return Product
     */
    public function setMinimalQuantity($minimalQuantity) {
        $this->minimalQuantity = $minimalQuantity;

        return $this;
    }

    /**
     * Get minimalQuantity
     *
     * @return integer
     */
    public function getMinimalQuantity() {
        return $this->minimalQuantity;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Product
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Product
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
     * @return Product
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
     * Add image
     *
     * @param ProductImage $image
     *
     * @return Product
     */
    public function addImage(ProductImage $image) {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param ProductImage $image
     */
    public function removeImage(ProductImage $image) {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return Collection
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * This method is sorely for coding standard of the project
     * @param ProductImage $image
     * @return Product
     */
    public function setImages(ProductImage $image) {
        return $this->addImage($image);
    }

    /**
     * Set section
     *
     * @param Section $section
     *
     * @return Product
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

}

