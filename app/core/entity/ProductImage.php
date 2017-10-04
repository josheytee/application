<?php

namespace app\core\entity;


/**
 * ProductImage
 */
class ProductImage {
  /**
   * @var integer
   */
  private $id;

  /**
   * @var string
   */
  private $name;

  /**
   * @var integer
   */
  private $width;

  /**
   * @var integer
   */
  private $height;

  /**
   * @var Product
   */
  private $product;


  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   *
   * @return ProductImage
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
   * Set width
   *
   * @param integer $width
   *
   * @return ProductImage
   */
  public function setWidth($width) {
    $this->width = $width;

    return $this;
  }

  /**
   * Get width
   *
   * @return integer
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * Set height
   *
   * @param integer $height
   *
   * @return ProductImage
   */
  public function setHeight($height) {
    $this->height = $height;

    return $this;
  }

  /**
   * Get height
   *
   * @return integer
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * Set product
   *
   * @param Product $product
   *
   * @return ProductImage
   */
  public function setProduct(Product $product = null) {
    $this->product = $product;

    return $this;
  }

  /**
   * Get product
   *
   * @return Product
   */
  public function getProduct() {
    return $this->product;
  }
}
