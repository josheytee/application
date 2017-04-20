<?php



/**
 * Occupation
 */
class Occupation
{
    /**
     * @var integer
     */
    private $id_occupation;

    /**
     * @var \DateTime
     */
    private $startedOn;

    /**
     * @var integer
     */
    private $monthlySalary;

    /**
     * @var \User
     */
    private $user;

    /**
     * @var \Shop
     */
    private $shop;

    /**
     * @var \Profile
     */
    private $profile;


    /**
     * Get idOccupation
     *
     * @return integer
     */
    public function getIdOccupation()
    {
        return $this->id_occupation;
    }

    /**
     * Set startedOn
     *
     * @param \DateTime $startedOn
     *
     * @return Occupation
     */
    public function setStartedOn($startedOn)
    {
        $this->startedOn = $startedOn;

        return $this;
    }

    /**
     * Get startedOn
     *
     * @return \DateTime
     */
    public function getStartedOn()
    {
        return $this->startedOn;
    }

    /**
     * Set monthlySalary
     *
     * @param integer $monthlySalary
     *
     * @return Occupation
     */
    public function setMonthlySalary($monthlySalary)
    {
        $this->monthlySalary = $monthlySalary;

        return $this;
    }

    /**
     * Get monthlySalary
     *
     * @return integer
     */
    public function getMonthlySalary()
    {
        return $this->monthlySalary;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return Occupation
     */
    public function setUser(\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set shop
     *
     * @param \Shop $shop
     *
     * @return Occupation
     */
    public function setShop(\Shop $shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return \Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set profile
     *
     * @param \Profile $profile
     *
     * @return Occupation
     */
    public function setProfile(\Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}

