<?php

namespace app\core\entity;

/**
 * Section
 */
class Section extends Object {

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
     * @var \app\core\entity\Shop
     */
    private $shop;

    /**
     * @var \app\core\entity\Section
     */
    private $section;

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
     * Set shop
     *
     * @param \app\core\entity\Shop $shop
     *
     * @return Section
     */
    public function setShop(\app\core\entity\Shop $shop = null) {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return \app\core\entity\Shop
     */
    public function getShop() {
        return $this->shop;
    }

    /**
     * Set section
     *
     * @param \app\core\entity\Section $section
     *
     * @return Section
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
