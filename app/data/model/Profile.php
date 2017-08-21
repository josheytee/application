<?php

namespace model;

/**
 * Description of Profile
 * @Entity
 * @author adapter
 */
class Profile {

  /**
   * @var int
   *
   * @Id
   * @GeneratedValue
   * @Column(type="integer")
   */
  public $id_profile;

  /**
   * @var Occupation
   *
   * @OneToMany(targetEntity="Occupation", mappedBy="profile", cascade={"remove"})
   */
  public $occupations;

  /**
   * @var string
   *
   * @Column(type="string")
   */
  public $name;

  /**
   * Constructor
   */
  public function __construct() {
    $this->occupations = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Get idProfile
   *
   * @return integer
   */
  public function getIdProfile() {
    return $this->id_profile;
  }

  /**
   * Set name
   *
   * @param string $name
   *
   * @return Profile
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
   * Add occupations
   *
   * @param \Occupation $occupations
   *
   * @return Profile
   */
  public function addOccupation(Occupation $occupation) {
    if (!$this->occupations->contains($occupation)) {
      $this->occupations->add($occupation);
    }

    return $this;
  }

  /**
   * Remove occupation
   *
   * @param \Occupation $occupations
   */
  public function removeOccupation(Occupation $occupation) {
    $this->occupations->removeElement($occupation);
  }

  /**
   * Get occupations
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getOccupation() {
    return $this->occupations;
  }

  /**
   * Get occupations
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getOccupations() {
    return $this->occupations;
  }

}
