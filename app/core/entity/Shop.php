<?php

namespace app\core\entity;

/**
 * Shop
 */
class Shop {
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
     * @var State
     */
    private $state;

    /**
     * @var Activity
     */
    private $activity;

    public function __construct() {
        $this->setActivity(new Activity());
        $this->setState(new State());
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Shop
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
     * @return Shop
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
     * Set state
     *
     * @param State $state
     *
     * @return Shop
     */
    public function setState(State $state = null) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return State
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set activity
     *
     * @param Activity $activity
     *
     * @return Shop
     */
    public function setActivity(Activity $activity = null) {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return Activity
     */
    public function getActivity() {
        return $this->activity;
    }

    /**
     * @var array
     */
    private $config;


    /**
     * Set config
     *
     * @param array $config
     *
     * @return Shop
     */
    public function setConfig($config) {
        $this->config = $config;

        return $this;
    }

    /**
     * Get config
     *
     * @return array
     */
    public function getConfig() {
        return $this->config;
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
