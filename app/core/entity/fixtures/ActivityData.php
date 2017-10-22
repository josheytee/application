<?php

namespace app\core\entity\fixtures;

use app\core\entity\Activity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Description of ActivityData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ActivityData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        foreach ($this->data() as $key => $value) {
            $activity = new Activity();
            $activity->setName($value);
            $activity->setDescription($faker->paragraph);
            $activity->setIcon($faker->url);
            $activity->setUrl($faker->url);
            $activity->setCreated($faker->dateTime);
            $activity->setUpdated($faker->dateTime);

            $manager->persist($activity);
        }
        $manager->flush();
        $this->addReference('activity', $activity);
    }

    public function data()
    {
        return array(
            0 => 'Choose your main activity',
            1 => 'Lingerie and Adult',
            2 => 'Animals and Pets',
            3 => 'Art and Culture',
            4 => 'Babies',
            5 => 'Beauty and Personal Care',
            6 => 'Cars',
            7 => 'Computer Hardware and Software',
            8 => 'Download',
            9 => 'Fashion and accessories',
            10 => 'Flowers, Gifts and Crafts',
            11 => 'Food and beverage',
            12 => 'HiFi, Photo and Video',
            13 => 'Home and Garden',
            14 => 'Home Appliances',
            15 => 'Jewelry',
            16 => 'Mobile and Telecom',
            17 => 'Services',
            18 => 'Shoes and accessories',
            19 => 'Sports and Entertainment',
            20 => 'Travel',
        );
    }

    public function getOrder(): int
    {
        return 3;
    }

}
