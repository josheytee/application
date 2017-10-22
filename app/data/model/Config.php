<?php

namespace model;

/**
 * Description of Config
 * @Entity(repositoryClass="ConfigRepository")
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Config
{

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_config;

//  /**
//   * @var string
//   *
//   * @Column(type="string")
//   */
//  public $name;

    /**
     * @var string
     *
     * @Column(type="blob",length=512)
     */
    public $data;

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
     * Get idConfig
     *
     * @return integer
     */
    public function getIdConfig()
    {
        return $this->id_config;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Config
     */
    public function setData($data)
    {
        $this->data = $data;

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
     * @return Config
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
     * @return Config
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

}
