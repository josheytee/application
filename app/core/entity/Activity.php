<?php

namespace app\core\entity;

/**
 * Activity
 */
class Activity extends Object {

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
    private $icon;

    /**
     * @var string
     */
    private $description;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Activity
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
     * @return Activity
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
     * Set icon
     *
     * @param string $icon
     *
     * @return Activity
     */
    public function setIcon($icon) {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon() {
        return $this->icon;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Activity
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

}
