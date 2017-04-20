<?php

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
    protected $id_shop;

    /**
     * @OneToOne(targetEntity="Category")
     * @JoinColumn(name="id_category",referencedColumnName="id_category")
     */
    protected $id_category;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @Column(type="string",unique=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $url;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @var user[]
     * @OneToMany(targetEntity="Occupation", mappedBy="shop", cascade={"remove"})
     */
    protected $occupation;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->occupation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idShop
     *
     * @return integer
     */
    public function getIdShop()
    {
        return $this->id_shop;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Shop
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set description
     *
     * @param string $description
     *
     * @return Shop
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set url
     *
     * @param string $url
     *
     * @return Shop
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Shop
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Shop
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set idCategory
     *
     * @param \Category $idCategory
     *
     * @return Shop
     */
    public function setIdCategory(\Category $idCategory = null)
    {
        $this->id_category = $idCategory;

        return $this;
    }

    /**
     * Get idCategory
     *
     * @return \Category
     */
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * Add occupation
     *
     * @param \Occupation $occupation
     *
     * @return Shop
     */
    public function addOccupation(\Occupation $occupation)
    {
        $this->occupation[] = $occupation;

        return $this;
    }

    /**
     * Remove occupation
     *
     * @param \Occupation $occupation
     */
    public function removeOccupation(\Occupation $occupation)
    {
        $this->occupation->removeElement($occupation);
    }

    /**
     * Get occupation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOccupation()
    {
        return $this->occupation;
    }
}
