<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use model\Shop;

/**
 * Description of ShopData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ShopData implements FixtureInterface {

  public function load(ObjectManager $manager) {
    $faker = Faker\Factory::create();
    for ($i = 1; $i <= 10; $i++) {
      $activity = $manager->find('model\Activity', $i);
      $shop = new Shop();
      $shop->setName($faker->company);
      $shop->setDescription($faker->paragraph);
      $shop->setActivity($activity);
      $shop->setUrl($faker->url);
      $shop->setCreated($faker->dateTime);
      $shop->setUpdated($faker->dateTime);

      $manager->persist($shop);
    }
    $manager->flush();
    $manager->clear();
  }

}
