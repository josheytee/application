<?php

namespace model;

/**
 * Module Entity
 *
 * @Entity(repositoryClass="ModuleRepository")
 * @Table(indexes={
 * @Index(name="id_module_name_version_idx",  columns={"id_module","name","version"})
 * })
 * @author adapter
 */
class Module
{

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_module;

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
    public $version;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $icon;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    public $created;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    public $updated;

    /**
     * @var moduleHook[]
     * @OneToMany(targetEntity="ModuleHook", mappedBy="module", cascade={"remove"})
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
     * Get idModule
     *
     * @return integer
     */
    public function getIdModule()
    {
        return $this->id_module;
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
     * @return Module
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
     * @return Module
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return Module
     */
    public function setVersion($version)
    {
        $this->version = $version;

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
     * @return Module
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Module
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Module
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Add moduleHook
     *
     * @param \model\ModuleHook $moduleHook
     *
     * @return Module
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
