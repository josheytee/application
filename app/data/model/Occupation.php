<?php

namespace model;

/**
 * @Entity
 *
 */
class Occupation
{

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    public $id_occupation;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="occupations")
     * @JoinColumn(name="id_user", referencedColumnName="id_user", nullable=FALSE)
     */
    public $user;

    /**
     * @ManyToOne(targetEntity="Shop", inversedBy="occupations")
     * @JoinColumn(name="id_shop", referencedColumnName="id_shop", nullable=FALSE)
     */
    public $shop;

    /**
     * @ManyToOne(targetEntity="Profile", inversedBy="occupations")
     * @JoinColumn(name="id_profile", referencedColumnName="id_profile", nullable=FALSE)
     */
    public $profile;

    /**
     * @Column(type="date", name="started_on")
     */
    public $started;

    /**
     * @Column(type="integer", name="monthly_salary")
     */
    public $monthlySalary;

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
     * Get monthlySalary
     *
     * @return integer
     */
    public function getMonthlySalary()
    {
        return $this->monthlySalary;
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
     * Get user
     *
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return Occupation
     */
    public function setUser(User $user)
    {
        $this->user = $user;

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
     * Set shop
     *
     * @param \Shop $shop
     *
     * @return Occupation
     */
    public function setShop(Shop $shop)
    {
        $this->shop = $shop;

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

    /**
     * Set profile
     *
     * @param \Profile $profile
     *
     * @return Occupation
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get started
     *
     * @return \DateTime
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set started
     *
     * @param \DateTime $started
     *
     * @return Occupation
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

}
