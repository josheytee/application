<?php

namespace model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Product entity
 *
 * @Entity(repositoryClass="ProductRepository")
 * @Table(indexes={
 * @Index(name="product_price_name_idx",  columns={"id_product","price","name"})
 * })
 */
class Product {

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_product;

    /**
     * @OneToOne(targetEntity="Category")
     * @JoinColumn(name="id_category",referencedColumnName="id_category")
     */
    public $category;

    /**
     * @OneToOne(targetEntity="Section")
     * @JoinColumn(name="id_section",referencedColumnName="id_section")
     */
    public $section;

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
     * @Column(type="boolean")
     */
    public $availability;

    /**
     * @var string
     *
     * @Column(type="decimal",scale=4)
     */
    public $price;

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
     * Get idProduct
     *
     * @return integer
     */
    public function getIdProduct() {
        return $this->id_product;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set availability
     *
     * @param \number $availability
     *
     * @return Product
     */
    public function setAvailability(\number $availability) {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return \number
     */
    public function getAvailability() {
        return $this->availability;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Product
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
     * @return Product
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
     * Set category
     *
     * @param \model\Category $category
     *
     * @return Product
     */
    public function setCategory(\model\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \model\Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set section
     *
     * @param \model\Section $section
     *
     * @return Product
     */
    public function setSection(\model\Section $section = null) {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \model\Section
     */
    public function getSection() {
        return $this->section;
    }

}
