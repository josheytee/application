<?php

namespace app\core\entity\fixtures;

use app\core\entity\Role;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Description of ShopData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RoleData implements FixtureInterface, DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $user = $manager->getRepository('app\core\entity\User')->findAll();
            $role = new Role();
            $role->setName($faker->name);
            $role->setCreatedBy($user);

      $role->setCreated($faker->dateTime);
      $role->setUpdated($faker->dateTime);

      $manager->persist($role);
    }
        $manager->flush();
        $manager->clear();
    }



    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
       return 1;
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return ['app\core\entity\fixtures\LoadUserData'];
    }
}
