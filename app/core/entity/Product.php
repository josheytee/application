<?php

namespace app\core\entity;

/**
 * Product
 */
class Product extends Object {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $short_description;

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
    private $available;

    /**
     * @var string
     */
    private $price;

    /**
     * @var boolean
     */
    private $show_price;

    /**
     * @var boolean
     */
    private $online_only;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var \app\core\entity\Section
     */
    private $section;

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
        $this->short_description = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription() {
        return $this->short_description;
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
        $this->show_price = $showPrice;

        return $this;
    }

    /**
     * Get showPrice
     *
     * @return boolean
     */
    public function getShowPrice() {
        return $this->show_price;
    }

    /**
     * Set onlineOnly
     *
     * @param boolean $onlineOnly
     *
     * @return Product
     */
    public function setOnlineOnly($onlineOnly) {
        $this->online_only = $onlineOnly;

        return $this;
    }

    /**
     * Get onlineOnly
     *
     * @return boolean
     */
    public function getOnlineOnly() {
        return $this->online_only;
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
     * Set section
     *
     * @param \app\core\entity\Section $section
     *
     * @return Product
     */
    public function setSection(\app\core\entity\Section $section = null) {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \app\core\entity\Section
     */
    public function getSection() {
        return $this->section;
    }

}
