<?php

namespace model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Description of Route
 * @Entity(repositoryClass="RouteRepository")
 *
 */
class Route {

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_route;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $name;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $path;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $state;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $params;

    /**
     * @var user[]
     *
     * @ManyToMany(targetEntity="User", inversedBy="route",
     * fetch="EAGER", cascade={"persist"}, orphanRemoval=true)
     * @JoinTable(
     * name="user_route",
     * inverseJoinColumns={@JoinColumn(name="id_user",
     * referencedColumnName="id_user")},
     * joinColumns={@JoinColumn(name="id_route",
     * referencedColumnName="id_route")}
     * )
     */
    protected $user;

    /**
     * Constructor
     */
    public function __construct() {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idRoute
     *
     * @return integer
     */
    public function getIdRoute() {
        return $this->id_route;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Route
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
     * @return Route
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
     * Set state
     *
     * @param string $state
     *
     * @return Route
     */
    public function setState($state) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set params
     *
     * @param string $params
     *
     * @return Route
     */
    public function setParams($params) {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return string
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * Add user
     *
     * @param \model\User $user
     *
     * @return Route
     */
    public function addUser(\model\User $user) {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \model\User $user
     */
    public function removeUser(\model\User $user) {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser() {
        return $this->user;
    }


    /**
     * Set path
     *
     * @param string $path
     *
     * @return Route
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
