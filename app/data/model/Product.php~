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
   * @OneToOne(targetEntity="Shop")
   * @JoinColumn(name="id_shop",referencedColumnName="id_shop")
   */
  public $shop;

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
   * @Column(type="text",length=320)
   */
  public $short_description;

  /**
   * @var string
   *
   * @Column(type="text", length=700)
   */
  public $description;

  /**
   * @var string
   *
   * @Column(type="string", columnDefinition="ENUM('new', 'used', 'refurbished')")
   */
  public $condition;

  /**
   * @var string
   *
   * @Column(type="string", columnDefinition="ENUM('simple', 'pack', 'virtual')")
   */
  public $type;

  /**
   * @var string
   *
   * @Column(type="boolean")
   */
  public $available_for_order;

  /**
   * @var string
   *
   * @Column(type="boolean")
   */
  public $show_price;

  /**
   * @var string
   *
   * @Column(type="decimal",scale=4)
   */
  public $price;

  /**
   * @var string
   *
   * @Column(type="boolean")
   */
  public $online_only;

  /**
   * @var string
   *
   * @Column(type="boolean")
   */
  public $active;

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

  /**
   * Set shop
   *
   * @param \model\Shop $shop
   *
   * @return Product
   */
  public function setShop(\model\Shop $shop = null) {
    $this->shop = $shop;

    return $this;
  }

  /**
   * Get shop
   *
   * @return \model\Shop
   */
  public function getShop() {
    return $this->shop;
  }

  /**
   * Set availableForOrder
   *
   * @param boolean $availableForOrder
   *
   * @return Product
   */
  public function setAvailableForOrder($availableForOrder) {
    $this->available_for_order = $availableForOrder;

    return $this;
  }

  /**
   * Get availableForOrder
   *
   * @return boolean
   */
  public function getAvailableForOrder() {
    return $this->available_for_order;
  }

  /**
   * Set showPrice
   *
   * @param boolean $showPrice
   *
   * @return Product
   */
  public function setShowPrice($showPrice) {
    $this->show_price = $showPrice;

    return $this;
  }

  /**
   * Get showPrice
   *
   * @return boolean
   */
  public function getShowPrice() {
    return $this->show_price;
  }

  /**
   * Set onlineOnly
   *
   * @param boolean $onlineOnly
   *
   * @return Product
   */
  public function setOnlineOnly($onlineOnly) {
    $this->online_only = $onlineOnly;

    return $this;
  }

  /**
   * Get onlineOnly
   *
   * @return boolean
   */
  public function getOnlineOnly() {
    return $this->online_only;
  }

  /**
   * Set active
   *
   * @param boolean $active
   *
   * @return Product
   */
  public function setActive($active) {
    $this->active = $active;

    return $this;
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
   * Set condition
   *
   * @param string $condition
   *
   * @return Product
   */
  public function setCondition($condition) {
    $this->condition = $condition;

    return $this;
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
   * Set type
   *
   * @param string $type
   *
   * @return Product
   */
  public function setType($type) {
    $this->type = $type;

    return $this;
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
   * Set shortDescription
   *
   * @param string $shortDescription
   *
   * @return Product
   */
  public function setShortDescription($shortDescription) {
    $this->short_description = $shortDescription;

    return $this;
  }

  /**
   * Get shortDescription
   *
   * @return string
   */
  public function getShortDescription() {
    return $this->short_description;
  }

}
