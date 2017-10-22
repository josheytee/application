<?php

namespace app\core\entity\fixtures;

use app\core\entity\Profile;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 *
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProfileData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $profile = new Profile();
            $profile->setName($faker->name);
            $profile->setCreated($faker->dateTime);
            $profile->setUpdated($faker->dateTime);

            $manager->persist($profile);
        }
        $manager->flush();
        $this->addReference('profile', $profile);
    }

    public function getOrder(): int
    {
        return 2;
    }

}
