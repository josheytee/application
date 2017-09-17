<?php

namespace model;

/**
 * Category entity
 *
 * @Entity(repositoryClass="ActivityRepository")
 * @Table(indexes={
 * @Index(name="id_activity_url_idx",  columns={"id_activity","url"})
 * })
 */
class Activity {

  /**
   * @var int
   *
   * @Id
   * @GeneratedValue
   * @Column(type="integer")
   */
  public $id_activity;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $name;

  /**
   * @var string
   *
   * @Column(type="text", length=320)
   */
  public $description;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $url;

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
   * Set name
   *
   * @param string $name
   *
   * @return Activity
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
   * @return Activity
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
   * Set url
   *
   * @param string $url
   *
   * @return Activity
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
   * Set icon
   *
   * @param string $icon
   *
   * @return Activity
   */
  public function setIcon($icon) {
    $this->icon = $icon;

    return $this;
  }

  /**
   * Get icon
   *
   * @return string
   */
  public function getIcon() {
    return $this->icon;
  }

  /**
   * Set created
   *
   * @param \DateTime $created
   *
   * @return Activity
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
   * @return Activity
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
   * Get idActivity
   *
   * @return integer
   */
  public function getIdActivity() {
    return $this->id_activity;
  }

}
