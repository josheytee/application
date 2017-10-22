<?php

namespace app\core\entity\fixtures;

use app\core\entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class RoleData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $role = new Role();
            $role->setName($faker->name);
            $role->setProfile($this->getReference('profile'));
            $role->setShop($this->getReference('shop'));
            $role->addUser($this->getReference('user'));


            $role->setCreated($faker->dateTime);
            $role->setUpdated($faker->dateTime);

            $manager->persist($role);
        }
        $manager->flush();
        $this->addReference('role', $role);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 6;
    }

}
