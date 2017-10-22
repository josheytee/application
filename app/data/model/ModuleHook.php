<?php

namespace model;

/**
 * Category entity
 *
 * @Entity
 * @Table(indexes={
 * @Index(name="id_hook_id_module_idx",  columns={"id_module","id_hook"})
 * })
 */
class ModuleHook
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
     * @ManyToOne(targetEntity="Module", inversedBy="moduleHook")
     * @JoinColumn(name="id_module", referencedColumnName="id_module", nullable=FALSE)
     */
    public $module;

    /**
     * @ManyToOne(targetEntity="Hook", inversedBy="moduleHook")
     * @JoinColumn(name="id_hook", referencedColumnName="id_hook", nullable=FALSE)
     */
    public $hook;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $position;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $active;

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
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return ModuleHook
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param string $active
     *
     * @return ModuleHook
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get module
     *
     * @return \model\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set module
     *
     * @param \model\Module $module
     *
     * @return ModuleHook
     */
    public function setModule(\model\Module $module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get hook
     *
     * @return \model\Hook
     */
    public function getHook()
    {
        return $this->hook;
    }

    /**
     * Set hook
     *
     * @param \model\Hook $hook
     *
     * @return ModuleHook
     */
    public function setHook(\model\Hook $hook)
    {
        $this->hook = $hook;

        return $this;
    }

}
