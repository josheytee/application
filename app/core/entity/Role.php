<?php

namespace app\core\entity;

/**
 * Role
 */
class Role extends Object {

    /**
     * @var string
     */
    private $name;

    /**
     * @var \app\core\entity\User
     */
    private $admin;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Role
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
     * Set admin
     *
     * @param \app\core\entity\User $admin
     *
     * @return Role
     */
    public function setAdmin(\app\core\entity\User $admin = null) {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \app\core\entity\User
     */
    public function getAdmin() {
        return $this->admin;
    }

}
