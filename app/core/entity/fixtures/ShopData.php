<?php
namespace app\core\entity\fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use app\core\entity\Shop;
use Faker;
/**
 * Description of ShopData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ShopData implements FixtureInterface,DependentFixtureInterface {

  public function load(ObjectManager $manager) {
    $faker = Faker\Factory::create();
    for ($i = 1; $i <= 10; $i++) {
      $activity = $manager->getRepository('app\core\entity\Activity')->findAll();
      $shop = new Shop();
      $shop->setName($faker->name);
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

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return ['app\core\entity\fixtures\ActivityData'];
    }
}
