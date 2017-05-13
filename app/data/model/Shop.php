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
 * Shop entity
 *
 * @Entity(repositoryClass="ShopRepository")
 * @Table(indexes={
 * @Index(name="category_url_idx",  columns={"id_category","url"})
 * })
 */
class Shop {

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_shop;

    /**
     * @OneToOne(targetEntity="Category")
     * @JoinColumn(name="id_category",referencedColumnName="id_category")
     */
    public $category;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    public $name;

    /**
     * @var string
     *
     * @Column(type="string",unique=true)
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
     * @var user[]
     * @OneToMany(targetEntity="Occupation", mappedBy="shop", cascade={"remove"})
     */
    public $occupations;

    /**
     * Constructor
     */
    public function __construct() {
        $this->occupations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idShop
     *
     * @return integer
     */
    public function getIdShop() {
        return $this->id_shop;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Shop
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
     * @return Shop
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
     * @return Shop
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
     * Set idCategory
     *
     * @param \Category $idCategory
     *
     * @return Shop
     */
    public function setIdCategory(\Category $idCategory = null) {
        $this->id_category = $idCategory;

        return $this;
    }

    /**
     * Get idCategory
     *
     * @return \Category
     */
    public function getIdCategory() {
        return $this->id_category;
    }

    /**
     * Add occupation
     *
     * @param \Occupation $occupation
     *
     * @return Shop
     */
    public function addOccupation(Occupation $occupation) {
//        $this->occupations[] = $occupation;
        if (!$this->occupations->contains($occupation)) {
            $this->occupations->add($occupation);
            $occupation->setShop($this);
        }

        return $this;
    }

    /**
     * Remove occupation
     *
     * @param \Occupation $occupation
     */
    public function removeOccupation(\Occupation $occupation) {
//        $this->occupations->removeElement($occupation);
        if ($this->occupations->contains($occupation)) {
            $this->occupations->removeElement($occupation);
            $occupation->setShop(null);
        }
        return $this;
    }

    public function getPeople() {
        return array_map(
                function ($occupation) {
            return $occupation->getUser();
        }, $this->occupations->toArray()
        );
    }

//    /**
//     * Get occupation
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getOccupation() {
//        return $this->occupations;
//    }

    /**
     * Get occupations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOccupations() {
        return $this->occupations;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Shop
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
     * @return Shop
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
     * @return Shop
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

}
