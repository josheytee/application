<?php

namespace app\core\entity\fixtures;

/**
 * Description of LoadUserData.php
 * User: adapter
 * Date: 3/21/2017
 * Time: 8:47 PM
 */
use app\core\entity\User;
use Faker;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface {

//2553
    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create();
        $role = $manager->getRepository('app\core\entity\Role')->findAll();

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
//            $user->setRememberToken($faker->randomKey());
            $user->setEmail($faker->email);
            $user->setPhone($faker->phoneNumber);
            $user->addRole($this->getReference('role'));
            $user->setCreated($faker->dateTime);
            $user->setUpdated($faker->dateTime);

            $manager->persist($user);
        }
        $manager->flush();
        $this->addReference('user', $user);
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }

}
