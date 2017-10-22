<?php

namespace model;

/**
 * Hook Entity
 *
 * @Entity(repositoryClass="HookRepository")
 * @Table(indexes={
 * @Index(name="id_hook_name_idx",  columns={"id_hook","name"})
 * })
 * @author adapter
 */
class Hook
{

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_hook;

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
    public $description;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $icon;

    /**
     * @var moduleHook[]
     * @OneToMany(targetEntity="ModuleHook", mappedBy="hook", cascade={"remove"})
     */
    public $moduleHook;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->moduleHook = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idHook
     *
     * @return integer
     */
    public function getIdHook()
    {
        return $this->id_hook;
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
     * @return Hook
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Hook
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Hook
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Add moduleHook
     *
     * @param \model\ModuleHook $moduleHook
     *
     * @return Hook
     */
    public function addModuleHook(\model\ModuleHook $moduleHook)
    {
        $this->moduleHook[] = $moduleHook;

        return $this;
    }

    /**
     * Remove moduleHook
     *
     * @param \model\ModuleHook $moduleHook
     */
    public function removeModuleHook(\model\ModuleHook $moduleHook)
    {
        $this->moduleHook->removeElement($moduleHook);
    }

    /**
     * Get moduleHook
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModuleHook()
    {
        return $this->moduleHook;
    }
}
