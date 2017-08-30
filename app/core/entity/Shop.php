<?php

namespace app\core\entity;

/**
 * Shop
 */
class Shop extends Object {

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
     * @var \app\core\entity\Activity
     */
    private $activity;

    /**
     * @var \app\core\entity\State
     */
    private $state;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Shop
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
     * @return Shop
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
     * @return Shop
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
     * Set activity
     *
     * @param \app\core\entity\Activity $activity
     *
     * @return Shop
     */
    public function setActivity(\app\core\entity\Activity $activity = null) {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \app\core\entity\Activity
     */
    public function getActivity() {
        return $this->activity;
    }

    /**
     * Set state
     *
     * @param \app\core\entity\State $state
     *
     * @return Shop
     */
    public function setState(\app\core\entity\State $state = null) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \app\core\entity\State
     */
    public function getState() {
        return $this->state;
    }

}
