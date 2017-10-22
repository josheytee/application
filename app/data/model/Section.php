<?php

namespace model;

/**
 * Section entity
 *
 * @Entity(repositoryClass="SectionRepository")
 * @Table(indexes={
 * @Index(name="section_url_idx",  columns={"id_section","url"})
 * })
 */
class Section
{

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_section;

    /**
     * @OneToOne(targetEntity="Section")
     * @JoinColumn(name="id_section",referencedColumnName="id_section")
     */
    public $parent;

    /**
     * @OneToOne(targetEntity="Shop")
     * @JoinColumn(name="id_shop",referencedColumnName="id_shop")
     */
    public $shop;

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
    public $url;

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
     * Get idSection
     *
     * @return integer
     */
    public function getIdSection()
    {
        return $this->id_section;
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
     * @return Section
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
     * @return Section
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Section
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * @return Section
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
     * @return Section
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \model\Section
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent
     *
     * @param \model\Section $parent
     *
     * @return Section
     */
    public function setParent(\model\Section $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get shop
     *
     * @return \model\Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set shop
     *
     * @param \model\Shop $shop
     *
     * @return Section
     */
    public function setShop(\model\Shop $shop = null)
    {
        $this->shop = $shop;

        return $this;
    }

}
