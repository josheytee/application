<?php

namespace app\core\entity\defaults\en;


class Product {


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
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
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription() {
        return $this->shortDescription;
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
     * Get condition
     *
     * @return string
     */
    public function getCondition() {
        return $this->condition;
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
     * Get available
     *
     * @return boolean
     */
    public function getAvailable() {
        return $this->available;
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
     * Get showPrice
     *
     * @return boolean
     */
    public function getShowPrice() {
        return $this->showPrice;
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
     * Get active
     *
     * @return boolean
     */
    public function getActive() {
        return $this->active;
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
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() {
        return $this->updated;
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
