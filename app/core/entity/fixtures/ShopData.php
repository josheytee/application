<?php

namespace app\core\entity\fixtures;

use app\core\entity\Shop;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 *
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ShopData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $activity = $manager->getRepository('app\core\entity\Activity')->findAll();
            $shop = new Shop();
            $shop->setName($faker->name);
            $shop->setDescription($faker->paragraph);
            $shop->setActivity($this->getReference('activity'));
            $shop->setState($this->getReference('state'));
            $shop->setUrl($faker->url);
            $shop->setCreated($faker->dateTime);
            $shop->setUpdated($faker->dateTime);

            $manager->persist($shop);
        }
        $manager->flush();
        $this->addReference('shop', $shop);
    }

    public function getOrder(): int
    {
        return 5;
    }

}
