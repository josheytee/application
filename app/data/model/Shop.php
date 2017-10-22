<?php

namespace model;

/**
 * Shop entity
 *
 * @Entity(repositoryClass="ShopRepository")
 * @Table(indexes={
 * @Index(name="activity_url_idx",  columns={"id_activity","url"})
 * })
 */
class Shop
{

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id_shop;

    /**
     * @OneToOne(targetEntity="Activity")
     * @JoinColumn(name="id_activity",referencedColumnName="id_activity")
     */
    public $activity;

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
    public function __construct()
    {
        $this->occupations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Shop
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
     * @return Shop
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
     * @return Shop
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Add occupation
     *
     * @param \Occupation $occupation
     *
     * @return Shop
     */
    public function addOccupation(Occupation $occupation)
    {
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
    public function removeOccupation(Occupation $occupation)
    {
//        $this->occupations->removeElement($occupation);
        if ($this->occupations->contains($occupation)) {
            $this->occupations->removeElement($occupation);
            $occupation->setShop(null);
        }
        return $this;
    }

    public function getPeople()
    {
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
    public function getOccupations()
    {
        return $this->occupations;
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
     * @return Shop
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
     * @return Shop
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \model\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set activity
     *
     * @param \model\Activity $activity
     *
     * @return Shop
     */
    public function setActivity(\model\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

}
