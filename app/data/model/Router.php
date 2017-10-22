<?php

namespace model;

/**
 * Description of Route
 * @Entity(repositoryClass="RouterRepository")
 *
 */
class Router
{

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
     * @Column(type="object")
     */
    public $route;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $path;

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
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idRoute
     *
     * @return integer
     */
    public function getIdRoute()
    {
        return $this->id_route;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Router
     */
    public function setName($name)
    {
        $this->name = $name;

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

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Router
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Router
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Add user
     *
     * @param \model\User $user
     *
     * @return Router
     */
    public function addUser(\model\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \model\User $user
     */
    public function removeUser(\model\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

}
