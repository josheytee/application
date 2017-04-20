<?php



/**
 * Shop
 */
class Shop
{
    /**
     * @var integer
     */
    private $id_shop;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Category
     */
    private $id_category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $occupation;

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

