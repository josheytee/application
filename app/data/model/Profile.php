<?php

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
    protected $id_profile;

    /**
     * @var Occupation
     *
     * @OneToMany(targetEntity="Occupation", mappedBy="profile", cascade={"remove"})
     */
    protected $occupation;
    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $name;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->occupation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idProfile
     *
     * @return integer
     */
    public function getIdProfile()
    {
        return $this->id_profile;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Profile
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
     * Add occupation
     *
     * @param \Occupation $occupation
     *
     * @return Profile
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
